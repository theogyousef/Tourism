<?php
require_once "../model/Model.php";
class fetchModle extends Model
{

    public function allhotels()
    {
        $conn = $this->getConn();
        $query = "SELECT * FROM hotels ";
        $result = mysqli_query($conn, $query);
        return $result;
    }


    public function getProductById($productId)
    {
        $conn = $this->getConn();
        $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    public function getProductsByPriceRange($minPrice, $maxPrice)
    {
        $conn = $this->getConn();
        $query = "SELECT * FROM products WHERE price BETWEEN '$minPrice' AND '$maxPrice'";
        $result = mysqli_query($conn, $query);

        // Check for errors
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }


        return $result;
    }
    public function highesttolowest()
    {
        $conn = $this->getConn();

        // Modify the query to fetch products within the specified price range
        $query = "SELECT * FROM products ORDER BY price DESC";
        $result = mysqli_query($conn, $query);

        // Check for errors
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }


        return $result;
    }
    public function lowesttohighest()
    {
        $conn = $this->getConn();

        // Modify the query to fetch products within the specified price range
        $query = "SELECT * FROM products ORDER BY price ASC";
        $result = mysqli_query($conn, $query);

        // Check for errors
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }


        return $result;
    }
    public function inStock()
    {
        $conn = $this->getConn();

        // Modify the query to fetch products within the specified price range
        $query = "SELECT * FROM products WHERE stock > '0'";
        $result = mysqli_query($conn, $query);

        // Check for errors
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }


        return $result;
    }
    public  function OutOfStock()
    {
        $conn = $this->getConn();

        // Modify the query to fetch products within the specified price range
        $query = "SELECT * FROM products WHERE stock < '1'";
        $result = mysqli_query($conn, $query);

        // Check for errors
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }


        return $result;
    }
    public function Benches()
    {
        $conn = $this->getConn();
        $query = "SELECT * FROM products WHERE type ='Benches'";
        $result = mysqli_query($conn, $query);
        return $result;

    }
    public function Barbell()
    {
        $conn = $this->getConn();
        $query = "SELECT * FROM products WHERE type ='Barbell'";
        $result = mysqli_query($conn, $query);
        return $result;
    }
    public function Kettlebell()
    {
        $conn = $this->getConn();
        $query = "SELECT * FROM products WHERE type ='Kettlebell '";
        $result = mysqli_query($conn, $query);
        return $result;
    }
    public function Bicycle()
    {

        $conn = $this->getConn();
        $query = "SELECT * FROM products WHERE type ='Bicycle'";
        $result = mysqli_query($conn, $query);
        return $result;
    }
    public function Cardio()
    {
        $conn = $this->getConn();
        $query = "SELECT * FROM products WHERE type ='Cardio'";
        $result = mysqli_query($conn, $query);
        return $result;
    }
    public function Sleds()
    {
        $conn = $this->getConn();
        $query = "SELECT * FROM products WHERE type ='Sleds'";
        $result = mysqli_query($conn, $query);
        return $result;
    }
    public function Plates()
    {
        $conn = $this->getConn();
        $query = "SELECT * FROM products WHERE type ='Plates'";
        $result = mysqli_query($conn, $query);
        return $result;
    }
    public function Collars()
    {
        $conn = $this->getConn();
        $query = "SELECT * FROM products WHERE type ='Collars'";
        $result = mysqli_query($conn, $query);
        return $result;
    }
    public function Ropes()
    {
        $conn = $this->getConn();
        $query = "SELECT * FROM products WHERE type ='Rope'";
        $result = mysqli_query($conn, $query);
        return $result;
    }
    public function Boxs()
    {
        $conn = $this->getConn();
        $query = "SELECT * FROM products WHERE type ='Box'";
        $result = mysqli_query($conn, $query);
        return $result;
    }
    public function Steps()
    {
        $conn = $this->getConn();
        $query = "SELECT * FROM products WHERE type ='Step'";
        $result = mysqli_query($conn, $query);
        return $result;
    }
    public function Weightedballs()
    {
        $conn = $this->getConn();
        $query = "SELECT * FROM products WHERE type ='Weighted balls'";
        $result = mysqli_query($conn, $query);
        return $result;
    }
    public function Racks()
    {
        $conn = $this->getConn();

        $query = "SELECT * FROM products WHERE type ='Racks'";
        $result = mysqli_query($conn, $query);

        // Check for errors
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }


        return $result;
    }
    public function Dumbells()
    {
        $conn = $this->getConn();

        $query = "SELECT * FROM products WHERE type ='Dumbell'";
        $result = mysqli_query($conn, $query);

        // Check for errors
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }


        return $result;
    }
    public function CableExtensions()
    {
        $conn = $this->getConn();

        $query = "SELECT * FROM products WHERE type ='Cable Extensions'";
        $result = mysqli_query($conn, $query);

        // Check for errors
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }


        return $result;
    }

    public function Mat()
    {
        $conn = $this->getConn();

        $query = "SELECT * FROM products WHERE type ='Mat'";
        $result = mysqli_query($conn, $query);

        // Check for errors
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }


        return $result;
    }

    public function weightlifting()
    {
        $conn = $this->getConn();

        $query = "SELECT * FROM products WHERE type ='Dumbell' OR type = 'Barbell' ";
        $result = mysqli_query($conn, $query);

        // Check for errors
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }


        return $result;
    }

    public function precor()
    {
        $conn = $this->getConn();

        $query = "SELECT * FROM products WHERE manufacture ='precor' ";
        $result = mysqli_query($conn, $query);

        // Check for errors
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }


        return $result;
    }

    public function technogym()
    {
        $conn = $this->getConn();

        $query = "SELECT * FROM products WHERE manufacture ='Tecnhogym' ";
        $result = mysqli_query($conn, $query);

        // Check for errors
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }


        return $result;
    }

}
