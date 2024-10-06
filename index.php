
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kent Music</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="js/bootstrap.bundle.min.js"></script>
</head>
    <body class="bg-dark-subtle">
        <?php include 'navbar.html' ?>
    <div class="container text-center card mt-2 p-2" id="container">       
      <div class="container">
        <table class="table md">
        <?php
        include 'db.php';
        $per_page_record=7;
        if(isset($_GET["page"])){
          $page=$_GET["page"];
        }else{
          $page =1;
        }

        $start_from =($page-1)*$per_page_record;
        $sql = "SELECT * From songs ORDER BY id DESC LIMIT $start_from, $per_page_record";
        $results= $conn->query($sql);
        $result= $conn->query($sql);
        while($row= $result->fetch_assoc()){
        echo  " 
        <tr>
        <td><img src='$row[imagepath]' alt=''  style='max-width:100%; width: 200px; height:auto;'></td>
        <td class='p-5'><a href='download.php?id=$row[id]' class='page-link lead'>$row[name]</a></td>
        </tr>
        ";
        
        }
        ?>
        </table>
    <nav aria-label="Page navigation  ">
        <div class="pagination text-center "> 
          <?php
          $query ="SELECT * FROM songs";
          $rs_result= $conn->query($query);
        
          $row=$rs_result->num_rows;
          $total_records =$row;
          echo "<br/>";
          $total_pages = ceil($total_records/$per_page_record);
          $pageLink="";
          if($page>=2){
            echo "<li class='page-item'><a class='text-decoration-none page-link' href='index.php?page=".($page-1)."'>Prev</a></li>";
          }
          for($i=1;$i<=$total_pages;$i++){
           // echo $pageLink;
            if($i==$page){
              $pageLink="<li class='page-item'><a class='text-decoration-none page-link' href='index.php?page=".$i."'>".$i."</a></li>";
            }else{
              $pageLink="<li class='page-item'><a class='text-decoration-none page-link' href='index.php?page=".$i."'>".$i."</a></li>";
            }
            echo $pageLink."";
          }
          //echo $pageLink;
         
          if($page < $total_pages){
            echo "<li class='page-item'><a class='text-decoration-none page-link' href='index.php?page=".($page+1)."'>Next</a></li>";
          }
          ?>
        </div>
        </nav>
    </div>
  </div>
        <!--- pagination
        <ul class="pagination p-3 bordered">
          <li><a href="#">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">4</a></li>
          <li><a href="#">5</a></li>
        </ul> -->
        <script>
        function showHint(str) {
            if (str.length === 0) {
                document.getElementById("txtHint").innerHTML = "";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState === 4 && this.status === 200) {
                        // Split the response by comma and display vertically
                        var suggestions = this.responseText.split(",");
                        var formattedSuggestions = suggestions.map(function(suggestion) {
                            return "<span onclick=\"fillInput('" + suggestion.trim() + "')\">" + suggestion.trim() + "</span><br>";
                        });
                        document.getElementById("txtHint").innerHTML = formattedSuggestions.join("");
                    }
                };
                xmlhttp.open("GET", "gethint.php?q=" + str, true);
                xmlhttp.send();
            }
        }

        // Function to fill the search input when clicking a suggestion
        function fillInput(suggestion) {
            document.getElementById("search").value = suggestion;
        }
    </script>

              </script>
        <footer class=" bg-dark-subtle p-5">
          <div class="text-center container">
          
            <h5>useful links</h5>
            <a href="" class="page-link">Top Trending</a>
            <a href="" class="page-link">Recently Searched</a>
            <a href="" class="page-link"></a>
          </div>
        </footer>
</body>
</html>