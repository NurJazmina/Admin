<div><br><br><br><h1 style="color:#696969; text-align:center">Personal Info</h1></div><br>
<div class="row">
<div class="col-md-1 section-1-box wow fadeInUp"></div>
<div class="col-md-10 section-1-box wow fadeInUp">
    <div class="card">
      <div class="card-header">
        <strong>Details</strong>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-sm">
            <div class="table-responsive">
              <table class="table table-bordered">
              <tbody>
                <tr>
                  <th scope="row" class="table-secondary">Name</th>
                  <td class="table-secondary"><?php echo $ConsumerFName; echo " "; echo $ConsumerLName; ?> </td>
                </tr>
                <tr>
                <th scope="row">ID Type</th>
                <td><?php echo $ConsumerIDType; ?></td>
                </tr>
                <tr>
                   <th scope="row">ID Number</th>
                    <td><?php echo $ConsumerIDNo; ?></td>
                </tr>
                <tr>
                  <th scope="row">Email</th>
                <td><?php echo $ConsumerEmail; ?></td>
                </tr>
                <tr>
                  <th scope="row">Phone Number</th>
                  <td><?php echo $ConsumerPhone; ?></td>
                </tr>
                <tr>
                  <th scope="row">Address</th>
                  <td><?php echo $ConsumerAddress; ?></td>
                </tr>
                <tr>
                   <th scope="row">Status</th>
                   <td><?php echo $ConsumerStatus; ?></td>
                </tr>
              </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
</div>