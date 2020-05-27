<div class='container main reports-view {{ padded }}' ng-controller="SigninController">
    <div class="row">
        <div class='col-md-4'>
        </div>

<!-- <div ng-controller="SigninController"> -->
    <!-- <script type="text/ng-template" id="signin.html"> -->
        <div class='col-md-4'>
        <div class="modal-header">
            <h3 class="modal-title"><i class="fa fa-sign-in"></i> &nbsp; Please Sign-in</h3>
        </div>
        
        <!-- signin form -->
        <form class="form" ng-model="query" ng-controller="SigninController">
            <div class="modal-body">
                <div class="row" ng-if="invalidLogin">
                    <div class="col-md-12">
                        <div class="alert alert-danger">
                            <i class="fa fa-warning"></i> &nbsp; Invalid username or password.
                        </div>
                    </div>
                </div>
                
                <div class="row" ng-if="loginSuccess">
                    <div class="col-md-12">
                        <div class="alert alert-success">
                            <i class="fa fa-check"></i> &nbsp; Login successful.
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>User Name:</label>
                            <input required type="text" class="form-control" ng-model="query.name" id="user" placeholder="Enter your username.." />
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Password:</label>
                            <input required type="password" class="form-control" ng-model="query.password" id="password" placeholder="Enter your password.." />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button ng-disabled="disabled" class="btn btn-success" type="button" ng-click="attemptLogin(query);" type="submit">OK</button>
                <button class="btn btn-default" type="button" ng-click="cancel()">Close</button>
            </div>
        </form>
    <!-- </script> -->
        </div>
        
        <div class='col-md-4'>
        </div>
</div>
</div>
