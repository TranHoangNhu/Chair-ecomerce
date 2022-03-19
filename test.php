<?php 
    include_once('db/connect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .multiselect {
        width: 200px;
        }

        .selectBox {
        position: relative;
        }

        .selectBox select {
        width: 100%;
        font-weight: bold;
        }

        .overSelect {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        }

        #checkboxes {
        display: none;
        border: 1px #dadada solid;
        }

        #checkboxes label {
        display: block;
        }

        #checkboxes label:hover {
        background-color: #1e90ff;
        }
    </style>

</head>
<body>
    <form>
        <div class="multiselect">

        <?php
            $sql_danhmuc = mysqli_query($mysqli,"SELECT * FROM tbl_category ORDER BY category_id ASC")
        ?>
            <div class="selectBox" onclick="showCheckboxes()">
            <select>
                <option>Select an option</option>
            </select>
            <div class="overSelect"></div>
            </div>
            <div id="checkboxes">
            <?php
                while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)){
            ?>
            <label for="<?php echo $row_danhmuc['category_id'] ?>">
                <input type="checkbox" id="<?php echo $row_danhmuc['category_id'] ?>" /><?php echo $row_danhmuc['category_name'] ?></label>
            <?php
            }
            ?>
            </div>
        </div>
        </form>
</body>
<script type="text/javascript">


</script>
</html>