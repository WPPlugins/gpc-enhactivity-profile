<?php
/**
 * Template to show the each comment activity
 *
 * @uses string $one_thumbnail_image
 * @uses string $link_to_comment
 * @uses string $title_of_the_blog
 * @uses string $title_of_the_post
 * @uses string $comment_rating
 * @uses string $comment_text
 * @uses string $comment_date
 * 
 */
?>
<table>
    <tbody>
    	
        <tr>
            <td rowspan="5" style="vertical-align:top; text-align: left;">                
                <?php echo $one_thumbnail_image?>
            </td>
        </tr>
        <tr>
            <th align=left style="vertical-align:top;">
            <?php _e('You commented on blog post');?>&nbsp;
                <a href="<?php echo $link_to_comment?>" style="text-decoration: none;">
                <?php echo $title_of_the_blog?>, 
                    <?php echo $title_of_the_post?>
                </a>
            </th>
        </tr>
        <tr>
            <td>                
                <?php echo $comment_rating?>
                <br />
            </td>
        </tr>
        <tr>
            <td>
                <a href="<?php echo $link_to_comment?>" style="text-decoration: none; color: #555555;">
                    <blockquote>
                        <?php echo $comment_text?>
                    </blockquote>
                </a>
            </td>
        </tr>
        <tr>
            <td>                
                <a href="<?php echo $link_to_comment?>" style="text-decoration: none; color: #555555;">
                    <?php _e('Date of comment: ')?>&nbsp;<?php echo date('m/d/Y h:i:s', $comment_date)?>
                </a>
            </td>
        </tr>
    </tbody>

