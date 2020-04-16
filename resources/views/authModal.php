<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Login </h5>
        <h5 class="modal-title do-not-show" id="registerModalLabel">Register </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form id="loginForm" action="<?php router('login') ?>">
            <input type="hidden" name="csrf_token" value="<?php echo CSRF_TOKEN; ?>">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="form-group">
                <p>Don't have an account? <a href="#" class="authFormToggle">Register</a></p>
            </div>
            <button type="submit" class="btn btn-primary" id="loginButton">Login</button>
        </form>


        <form id="registerForm" action="<?php router('register') ?>" class="do-not-show">
            <input type="hidden" name="csrf_token" value="<?php echo CSRF_TOKEN; ?>">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email"  name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control" id="" placeholder="Password">
                <small id="" class="form-text text-muted">Be sure you can remember your password.</small>
            </div>
            <div class="form-group">
                <p>Have an account? <a href="#" class="authFormToggle">Log in</a></p>
            </div>
            <button type="submit" class="btn btn-primary" id="registerButton">Register</button>
        </form>

        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
