<section class="no-padding-top no-padding-bottom">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6 col-sm-6">
          <div class="statistic-block block">
            <div class="progress-details d-flex align-items-end justify-content-between">
              <div class="title">
                <div class="icon"><i class="icon-user-1"></i></div><strong>Number of Registered Users</strong>
              </div>
              <div class="number dashtext-1">{{ $users }} / 100 (goal)</div>
            </div>
            <div class="progress progress-template">
              <div role="progressbar" style="width: {{ $users }}%" class="progress-bar progress-bar-template dashbg-1"></div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-sm-6">
          <div class="statistic-block block">
            <div class="progress-details d-flex align-items-end justify-content-between">
              <div class="title">
                <div class="icon"><i class="icon-contract"></i></div><strong>Number of Products</strong>
              </div>
              <div class="number dashtext-2">{{ $products }} / 100 (goal)</div>
            </div>
            <div class="progress progress-template">
              <div role="progressbar" style="width: {{ $products }}%" class="progress-bar progress-bar-template dashbg-2"></div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-sm-6">
          <div class="statistic-block block">
            <div class="progress-details d-flex align-items-end justify-content-between">
              <div class="title">
                <div class="icon"><i class="icon-paper-and-pencil"></i></div><strong>Total Orders</strong>
              </div>
              <div class="number dashtext-3">
                {{ $orders }} / 50 (goal)
              </div>
            </div>
            <div class="progress progress-template">
              <div role="progressbar" style="width: {{ $orders * 2 }}%" class="progress-bar progress-bar-template dashbg-3"></div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-sm-6">
          <div class="statistic-block block">
            <div class="progress-details d-flex align-items-end justify-content-between">
              <div class="title">
                <div class="icon"><i class="icon-writing-whiteboard"></i></div><strong>Delivered Orders</strong>
              </div>
              <div class="number dashtext-4">{{ $deliveredOrders }} / 100 (goal)</div>
            </div>
            <div class="progress progress-template">
              <div role="progressbar" style="width: {{ $deliveredOrders }}%" class="progress-bar progress-bar-template dashbg-4"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
