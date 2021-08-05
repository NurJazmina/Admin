<?php
if(!empty($_POST["keyword"])) 
{
    //$query ="SELECT * FROM country WHERE country_name like '" . $_POST["keyword"] . "%' ORDER BY country_name LIMIT 0,6";
    //$result = $db_handle->runQuery($query);
    $name = $_POST['keyword'];
    $result = array("Daniel", "Dennis", "Danny", "Jane");

    if(!empty($result)) 
    {
        ?>
        <ul id="country-list">
            <?php
            foreach($result as $name) 
            {
                    ?>
                    <li onClick="selectCountry('<?php echo $name ; ?>');"><?php echo  $name ; ?></li>
                    <!-- <li onClick="selectCountry('<?php echo $country["country_name"]; ?>');"><?php echo $country["country_name"]; ?></li> -->
                    <?php 

                
            }
            ?>
        </ul>
        <?php 
    }
}
 ?>