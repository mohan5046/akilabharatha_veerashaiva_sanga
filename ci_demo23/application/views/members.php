<div class="container">
     <div class="row">
          <div class="col-lg-12 col-sm-12">
               <h2><u><?php echo "Total ".count($memlist)." Members Added By You"; ?></u><br/></h2>
               <hr>
               <table class="table table-striped table-hover">
                    <thead>
                         <tr>
                              <th>#</th>
                              <th>Img</th>
                              <th>First Name</th>
                              <th>Last Name</th>
                              <th>Relationship</th>
                              <th>Edit</th>
                              <th>Delete</th>
                         </tr>
                    </thead>
                    <tbody>
                         <?php for ($i = 0; $i < count($memlist); ++$i) { ?>
                              <tr>
                                   <td><?php echo ($i+1); ?></td>
                                   <td><img src="<?php echo base_url($memlist[$i]->image); ?>" alt="No Img" width="103" height="113"></td>
                                   <td><?php echo $memlist[$i]->fname; ?></td>
                                   <td><?php echo $memlist[$i]->lname; ?></td>
                                   <td><?php echo $memlist[$i]->relationship; ?></td>
                                   <td><h4><a href="<?php echo site_url("main/member_edit/".$memlist[$i]->m_id); ?>">Edit</a></h4></td>
                                   <td><h4><?php echo anchor('main/member_delete/'.$memlist[$i]->m_id, 'Delete', array('class'=>'delete', 'onclick'=>"return confirmDialog();")); ?></h4></td>
                              </tr>
                         <?php } ?>
                    </tbody>
               </table>
               <script>
                    function confirmDialog() 
                    {
                         return confirm("Are you sure you want to delete this record?")
                    }
               </script>
          </div>
     </div>
</div>
<br/>