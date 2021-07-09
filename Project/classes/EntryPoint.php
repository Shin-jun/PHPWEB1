<?php
class EntryPoint
{
    private $route;

    public function __construct($route)
    {
        $this->route = $route;
        $this->checkUrl();
    }

    private function checkUrl() {
        if($this->route !== strtolower($this->route)) {
            http_response_code(301);
            header('loction: ' . strtolower($this->route));
        }
    }

    private function loadTemplate($templateFileName, $variables = []) {
        extract($variables);

        ob_start();
        include __DIR__ . '/../templates/' . $templateFileName;

        return ob_get_clean();
    }

    # 컨트롤러 클래스 추가 classes 디렉터리에 클래스 파일 저장 후 여기서 호출
    private function callAction() {
        include __DIR__ . '/../includes/DatabaseConnection.php';
	    include __DIR__ . '/../classes/DatabaseTable.php';

	    $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
	    $authorsTable = new DatabaseTable($pdo, 'author', 'id');


			if ($this->route === 'joke/list') {
				include __DIR__ . '/../classes/controllers/JokeController.php';
				$controller = new JokeController($jokesTable, $authorsTable);
				$page = $controller->list();
			}
			else if ($this->route === '') {
				include __DIR__ . '/../classes/controllers/JokeController.php';
				$controller = new JokeController($jokesTable, $authorsTable);
				$page = $controller->home();
			}
			else if ($this->route === 'joke/edit') {
				include __DIR__ . '/../classes/controllers/JokeController.php';
				$controller = new JokeController($jokesTable, $authorsTable);
				$page = $controller->edit();
			}
			else if ($this->route === 'joke/delete') {
				include __DIR__ . '/../classes/controllers/JokeController.php';
				$controller = new JokeController($jokesTable, $authorsTable);
				$page = $controller->delete();
			}
			else if ($this->route === 'register') {
				include __DIR__ . '/../classes/controllers/RegisterController.php';
				$controller = new RegisterController($authorsTable);
				$page = $controller->showForm();
			}
        return $page;
    }
    public function run() {
        $page = $this->callAction();
        $title = $page['title'];

        if(isset($page['variables'])) {
            $output = $this->loadTemplate($page['template'],
            $page['variables']);
        } else {
            $output = $this->loadTemplate($page['template']);
        }
        include __DIR__ . '/../templates/layout.html.php';
    }
}