<?php require dirname(__DIR__ ). '/incl/header.php'; ?>
<?php //flash('post_message'); ?>
<div class="row">
  <div class="col-md-6">
    <h1>Posts</h1>
  </div>
  <div class="col-md-6">
    <a href="<?php echo \App\Config\Config::URLROOT; ?>/posts/add" class="btn btn-primary pull-right">
      ✏Add Post
    </a>
  </div>
</div>
<?php if (isset($data['error_message'])) : ?>
    <?php echo $data['error_message']; ?>
<?php else: ?>
    <?php foreach ($data['posts'] as $post) : ?>
    <!--    --><?php //var_dump($post)?>
        <?php echo $post->getUser()->getName(); ?>
    <div class="card card-body mb-3">
      <h4 class="card-title"><?php echo $post; ?></h4>
      <div class="bg-light p-2 mb3">
        <!--      written by --><?php //echo $post->name; ?>
      </div>
      <p class="card-text"><?php echo $post->getBody(); ?></p>
      <a href="<?php echo \App\Config\Config::URLROOT; ?>/posts/show/<?php echo $post->PostId; ?>">More</a>
    </div>
    <?php endforeach; ?>
<?php endif; ?>
<?php require dirname(__DIR__ ). '/incl/footer.php'; ?><!--footer-->