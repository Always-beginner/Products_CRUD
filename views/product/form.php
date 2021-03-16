<?php if ($flage === 1) : ?>
    <div class='mt-3 alert alert-success alert-dismissible fade show' role='alert'>
        <strong> You're Product is Edited Successfully </strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>
<?php endif ?>



<?php if (!empty($error)) : ?>
    <?php foreach ($error as $er) : ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong><?php echo $er ?></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
<?php endforeach;
endif; ?>

<!-- form start here -->

<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <input type="text" name="title" value="<?php echo $title ?>" placeholder="Title" class="mt-3 form-control">
    </div>
    <div class="form-group">
        <input type="text" value="<?php echo $desc ?>" class="form-control mt-3" name="desc" placeholder="Description"></input>
    </div>
    <?php if ($products['image']) : ?>
        <img src="/<?php echo $products['image'] ?>" style="width: 60px;" alt="<?php echo $products['title'] ?>">
    <?php endif; ?>
    <div class="mt-3 form-group">
        <label>Product Image</label>
        <input type="file" class=" form-control" value="<?php echo $products['title'] ?>" name="image"></input>
    </div>
    <div class="form-group">
        <input type="number" class="form-control mt-3" step=".01" placeholder="Price" value="<?php echo $price ?>" name="price"></input>
    </div>
    <button type="submit" class="mt-3 btn btn-primary">Submit</button>
</form>

<!-- form end here -->