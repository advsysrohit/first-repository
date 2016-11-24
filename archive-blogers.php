<?php get_template_part('includes/header'); ?>
<?php  
$blogerargs = array(  'post_type'  => 'blogers',  
                                'post_status' => 'publish',  
                                'ignore_sticky_posts'=> true,  
                                'posts_per_page' => 5,);  
        $blogerobjs = new WP_Query( $blogerargs );  
        if($blogerobjs->have_posts())  
          {  
            $blogercount= 0; 
             while($blogerobjs->have_posts())  
            {  
               $blogerobjs->the_post(); 
               $blogerid[$blogercount]=get_the_ID(); 
               $blogertitle[$blogercount]=get_the_title(); 
               $blogercontent[$blogercount]=get_the_content(); 
               $blogercount++;  
             }  
                  wp_reset_query();  
          }  

/* End fetching top carousel slide data */  
?>
<div class="container">
  <div class="row">
    <?php
      for($i=0; $i<$blogercount; $i++) 
        { 
          echo "<h2>".$blogertitle[$i]."</h2>"; 
          echo "<p>".$blogercontent[$i]."</p>"; 
        } 
    ?>
    <div class="name_of_posts_class"></div>
    <a id="more_posts" class="btn btn-primary">Load More</a><img src='http://dev.systemicshost.com/rohittestwordpress/wp-content/themes/project%20mar/images/default.gif' class="abcfsh">
    <div style="margin-bottom: 100px;"></div>
  </div><!-- /.row -->
</div><!-- /.container -->
<style type="text/css">
  .abcfsh{
    display: none;
  }
</style>
<script type="text/javascript">

    var ajaxUrl = "<?php echo admin_url('admin-ajax.php')?>";
    var page = 1; // What page we are on.
    var ppp = 5; // Post per page
    jQuery(function($) {
    $("#more_posts").on("click",function(){ // When btn is pressed.
        $("#more_posts").attr("disabled",true); // Disable the button, temp.
        $(".abcfsh").show();
        $.post(ajaxUrl, {
            action:"more_post_ajax",
            offset: (page * ppp),
            ppp: ppp
        }).success(function(posts){
            page++;
            $(".name_of_posts_class").append(posts); // CHANGE THIS!
            $(".abcfsh").hide();
            $("#more_posts").attr("disabled",false);
        });

   });
 });
</script>
<?php get_template_part('includes/footer'); ?>
