<ul class="page-breadcrumb breadcrumb">
    <li>
        <?php echo anchor('', 'Home'); ?>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <?php echo anchor('', 'System Error'); ?>
    </li>
</ul>

<link rel="stylesheet" type="text/css" href="http://localhost/template/metronic_v4.5.5/theme/assets/pages/css/error.min.css">
<div class="row">
    <div class="col-md-12 page-404">
        <div class="number font-green"> 000 </div>
        <div class="details">
            <h3>Oops! System Error.</h3>
            <p> Hubungi Developer.
                <br/>
                <?php echo anchor("","Return home") ?></p>
           
        </div>
    </div>
</div>