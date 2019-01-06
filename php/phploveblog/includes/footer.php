</div><!-- /.blog-main -->

        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
          <div class="sidebar-module sidebar-module-inset">
            <h4>About</h4>
            <?php echo $site_description ; ?>  
          </div>
          <div class="sidebar-module">
            <h4>Categories</h4>
            <?php if($categories): ?>
            <ol class="list-unstyled">
            <?php while($row = $categories->fetch_assoc()): ?>
                <li><a href="posts.php?categories=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></li>
            <?php endwhile; ?>    
           </ol>
            <?php else: ?>
            <p>There are no categories yet</p>
            <?php endif; ?> 
          </div>
          
        </div><!-- /.blog-sidebar -->

      </div><!-- /.row -->

    </div><!-- /.container -->

    <div class="blog-footer">
      <p>PhpLoversBlog &@copy; 2014</p>
      <p>
        <a href="#">Back to top</a>
      </p>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="../js/bootstrap.js"></script>
   
  </body>
</html>
