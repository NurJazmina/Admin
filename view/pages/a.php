<style>
.view {
  float: left;
  overflow: hidden;
  position: relative;
  text-align: center;
}

.view .mask,
.view .content {
  overflow: hidden;
  bottom: 0;
}

.view.opacity {
    opacity: 1;
}

.view-first button {
  transform: translateY(-100px);
  opacity: 0;
  font-family: Raleway, serif;
  transition: all 0.6s ease-in-out;
}

.view-first:hover .opacity {
  opacity: 0.2;
}

.view-first:hover button,
.view-first:hover div.info {
  opacity: 1;
  transform: translateY(0px);
}
</style>

<div class="card card-custom card-stretch gutter-b view view-first">
    <!--begin::Body-->
    <div class="card-body d-flex flex-column opacity">
        <div class="text-center">
            <div class="row">
               fgbhgyhbgnbdsgcdsijgcvrnjhugvruiecvhguhxyueg
            </div>
        </div>
    </div>
    <form name="covid" action="index.php?page=covid" method="post">
        <div class="mask bg-light">
            <div class="text-center m-5"><button class="btn btn-success btn-hover-light btn-sm btn-block" type="submit" name="covid">More Info</button></div>
        </div>
    </form>
    <!--end::Body-->
</div>

<div class="col-lg-4 mb-3">
      <form name="detail" action="index.php?page=newsdetail&id=<?= $news_id ?>" method="post">
        <div class="card view view-first">
          <div class="opacity">
            <!-- begin :: display -->ujhkj
            <!-- end :: display -->
          </div>
          <form name="covid" action="index.php?page=covid" method="post">
              <div class="mask bg-light">
                  <div class="text-center m-5"><button class="btn btn-success btn-hover-light btn-sm btn-block" type="submit" name="covid">More Info</button></div>
              </div>
          </form>
        </div>
      </form>
    </div>