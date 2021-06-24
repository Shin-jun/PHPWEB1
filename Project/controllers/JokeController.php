
class JokeController {
    private $authorsTable;
    private $jokesTable;

    public function __construct(DatabaseTable $jokesTable, DatabaseTable $authorsTable) {
        $this->jokesTable = $jokesTable;
        $this->authorsTable = $authorsTable;
    }

    public function list() {
        $result = $this->jokesTable->findAll();

        $jokes = [];
        foreach ($result as $joke) {
        $author = $authorsTable->findAll($joke['authorId']);
        $jokes[] = [
        'id' => $joke['id'],
        'joketext' => $joke['joketext'],
        'jokedata' => $joke['jokedate'],
        'name' => $author['name'],
        'email' => $author['email']
        ];
    }   
        $title = '유머 글 목록';

        $totalJokes = $jokesTable->total();

        ob_start(); // 버퍼 저장 시작

        include __DIR__ . '/../templates/jokes.html.php'; // 출력 버퍼의 내용을 읽고 $output변수에 저장한다.

        $output = ob_get_clean(); // $output은 layout.html.php에서 사용된다.

        return ['ouput'=> $output, 'title'=> $title];
    }

    public function home() {
        $title = '인터넷 유머 세상';

        ob_start();

        include __DIR__ . '/../templates/home.html.php';

        $output = ob_get_clean();

        return ['ouput'=> $output, 'title'=> $title];
    }

    public function delete() {
        $this->jokesTable->delete($_POST['id']);

        header('location: jokes.php');
    }

    public function edit(){
        if (isset($_POST['joke'])) {
            $joke = $_POST['joke'];
            $joke['jokedate'] = new DateTime();
            $joke['authorId'] = 1;
    
            $jokesTable->save($joke);
    
            header('location: jokes.php');
        } else {
            if (isset($_GET['id'])) {
                $joke = $jokesTable->findById($_GET['id']);
            }
    
            $title = '유머 글 수정';
    
            ob_start();
    
            include __DIR__ . '/../templates/editjoke.html.php';
    
            $output = ob_get_clean();

            return ['ouput'=> $output, 'title'=> $title];
        }
    }

}