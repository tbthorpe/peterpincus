<style>

.subcatListing p{
    width:inherit;
    float:none;
}
<?php if ($sub == 1 ): ?>
.subcatListing{
    position:relative;
    border:none;
    width:910px;
    margin:20px auto;
}
.subcatListing:nth-of-type(1){
    margin-top:10px;
}
.subcat_copy{
    position:absolute;
    bottom:0px;
    width:100%;
    background:rgba(255,255,255,0.4);
    padding:15px 0;
}
.subcatListing h3{
    margin:0;
}
.subcatListing h3 a,.subcatListing h3 a:visited,.subcatListing h3 a:hover{
    color:white;
}
<?php endif; ?>
</style>
<?php foreach ($categories as $cat): ?>
    <div class="subcatListing">
        
        <div class="subcat_image">
            <?php if ($sub == 1): ?>
                <img src="/img/categories/<?php echo $cat['Category']['filename']; ?>">
            <?php endif; ?>
            <!-- <img src="/img/categories/thumb.cat.<?php echo $cat['Category']['filename']; ?>"> -->
        </div>
        <div class="subcat_copy" style="text-align:center;margin-top:20px;">
            <h3 style="align:center;"><a href="/categories/view/<?php echo $cat['Category']['id']; ?>"><?php echo $cat['Category']['title']; ?></a></h3>
            <?php echo $textile->parse($cat['Category']['copy']); ?>
        </div>
        
        <div style="clear:both;"></div>
    </div>
<?php endforeach; ?>

