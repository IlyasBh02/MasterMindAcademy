    <?php
    require_once __DIR__. "/./Database.php";
    abstract class User{
        protected $id;
        protected $nom;
        protected $email;
        protected $password;
        protected $role;

        public function __construct($nom,$email,$password,$role = null)
        {
            $this->nom = $nom;
            $this->email = $email;
            $this->password = password_hash($password, PASSWORD_BCRYPT);
            $this->role = $role;
        }

        public function register(){
            $db = Database::getInstance()->getConnection();
            $sql = 'insert into user(name,email,password,role) values(?,?,?,?)';
            $stmt = $db->prepare($sql);
            if($stmt->execute([$this->nom,$this->email,$this->password,$this->role])){
                if($this->role == "Enseignant"){
                    header("Location: ../enseignant/loginEnseignant.php");
                }
                else if($this->role == "Etudiant"){
                    header("Location: ../user/login.php");
                }
            }
            else{
                echo "error";
            }

        }

        abstract public static function login($email,$password);
        abstract public static function logout();
    }