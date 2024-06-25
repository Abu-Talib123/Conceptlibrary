

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $totalcount;?></h3>

                <p>Total Students</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
               <a href="<?=site_url('admin/student')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> 
            </div>
          </div>
           <?php 
if(isset($studentcount) && count($studentcount)>0)
{
foreach($studentcount as $result)
{
?>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php  if($result['active_users']){ echo $result['active_users'];}else { echo '-'; };?><!-- <sup style="font-size: 20px">%</sup> --></h3>

                <p>Active Students</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
               <a href="<?=site_url('admin/student')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> 
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php if($total_videos){echo $total_videos;}else { echo '-'; }?></h3>

                <p>Total Videos</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
               <a href="<?=site_url('admin/video')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> 
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php if($total_mockpapers) {echo $total_mockpapers;}else {echo '-';}?></h3>
                <p>Total Mockpapers</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
               <a href="<?=site_url('admin/exam')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> 
            </div>
          </div>
           <?php
                        }
                        }
                        ?>
          <!-- ./col -->
        </div>
        <!-- /.row -->
      
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  