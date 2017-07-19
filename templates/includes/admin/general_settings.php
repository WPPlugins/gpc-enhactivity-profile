<?php
/**
 * Template to show the administrator's setting
 *
 * @uses string $data['max']
 * @uses string $data['default_thumb']
 * 
 * @package admin
 * 
 * <code>
 * <?php
	$data['star_size'] = '30';
	$data['max'] = '5';
	$data['default_thumb'] = 'http://server.com/images/default.jpg';
 * ?>
 * </code>
 * 
 */
?>
<div class="wrap">
<?php include( GpcEnhactivityProfile::$plugin_dir . '/templates/includes/msg.php') ?>
<h2><?php _e('General Settings')?></h2>
<form action="?page=<?php echo $_GET['page']?>" method="post" enctype="multipart/form-data">
  <table class="form-table">
    <tr class="form-field">
      <th><label for="star_size"><?php _e('Size of Stars') ?></label></th>
      <td><input type="text" name="star_size" id="star_size" value="<?php echo $data['star_size'] ?>" /><p class="description"><?php _e('This is the size for stars to show the rating.') ?></p></td>
    </tr>
    <tr>
    <tr class="form-field">
      <th><label for="max"><?php _e('Max Items') ?></label></th>
      <td><input type="text" name="max" id="max" value="<?php echo $data['max'] ?>" /><p class="description"><?php _e('Please enter the max amount of comments to show.') ?></p></td>
    </tr>
    <tr>
		<th><label for="description"><?php _e('Default thumbnail'); ?></label></th>
		<td><input id="image" class="regular-text" type="file" style="width: auto;" name="image"/><br />
		<span class="description"><?php 
		if ($data['default_thumb']!='') {
			?>
			<img alt="" src="<?php echo $data['default_thumb']?>">
			<?php 
		}
		?> <?php _e("This image will be the default thumbnail for post that haven't any associated image. Only .jpg and .png are allowed."); ?></span>
		<?php 
		if ($data['default_thumb']!='') {
			?><br><a href="?page=<?php echo $_GET['page']?>&del_default_thumb=true"><?php _e('Delete')?></a><?php }?></td>
	</tr>	
  </table>
  <p class="submit">
    <input type="submit" value="<?php _e('Save changes') ?>" class="button-primary" name="Submit" />
  </p>
</form>
</div>