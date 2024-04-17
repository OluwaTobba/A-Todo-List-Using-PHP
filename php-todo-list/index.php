<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>PHP ToDo List</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php 
    require 'db_connect.php';
?>
    <div class="container">
        <h1>Todo List Using PHP</h1>

        <div class="row">
            <div class="col-2"></div>

            <div class="col-9" style="border-radius: 5px; background-color: #fff; padding: 30px;">
                <form action="add.php" method="POST" autocomplete="off">
                    <?php if(isset($_GET['mess']) && $_GET['mess'] == 'error'){ ?>
                        <p><input type="text" name="title" class="form-control form-control-lg" placeholder="Type something 😌" /></p>
                        <p><button type="submit" class="btn btn-primary btn-lg">Add</button></p>
                    <?php }else{ ?>
                        <p><input type="text" name="title" class="form-control form-control-lg" placeholder="What Are We Doing Today?" /></p>
                        <p><button type="submit" class="btn btn-primary btn-lg">Add</button></p>
                    <?php } ?>
                </form>
            </div>

            <div class="col-2"></div>
        </div>

        <?php
            $todos = $conn->query('SELECT * FROM todos ORDER BY id DESC');
        ?>

        <div class="row">
            <div class="col-2"></div>

            <div class="col-9" style="border-radius: 5px; background-color: #fff; padding: 30px; margin-top: 20px;">

                <?php if($todos->rowCount() <= 0){ ?>
                    <div class="todo-item">
                        <div class="empty">
                            <h1>Not doing anything today? 😢</h1>
                        </div>
                    </div>
                <?php } ?>

                <?php while($todo = $todos->fetch(PDO::FETCH_ASSOC)) { ?>
                    <div class="todo-item">
                        <span id="<?php echo $todo['id']; ?>" class="remove-to-do">x</span>

                        <?php if($todo["checked"]){ ?>
                            <input type="checkbox" class="check-box" data-todo-id="<?php echo $todo['id']; ?>" checked />
                            <h2 class="checked"><?php echo $todo['title'] ?></h2>
                        <?php }else { ?>
                            <input type="checkbox" data-todo-id="<?php echo $todo['id']; ?>" class="check-box" />
                            <h2><?php echo $todo['title'] ?></h2>
                        <?php } ?>
                        <br>

                        <small>Created: <?php echo $todo['date_time'] ?></small>
                    </div>
                <?php } ?>

            </div>

            <div class="col-2"></div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function(){
            $('.remove-to-do').click(function(){
                const id = $(this).attr('id');

                $.post('remove.php',
                        {id: id},
                        (data) => {
                            if(data){
                                $(this).parent().hide(600);
                            }
                        }
                );
            });

            $('.check-box').click(function(e){
                const id = $(this).attr('data-todo-id');

                $.post('check.php',
                        {id: id},
                        (data) => {
                            if(data != 'error'){
                                const h2 = $(this).next();
                                if(data === '1'){
                                    h2.removeClass('checked');
                                }else{
                                    h2.addClass('checked');
                                }
                            }
                        }
                );
            });
        });
    </script>
</body>
</html>