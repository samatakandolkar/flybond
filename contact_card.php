<!DOCTYPE html>
<html>
<body>

<form action="validation.php" method="post">
    <div class="form-group">
        <label class="d-block" for="Cname">Name</label>
        <input type="text" class="form-control" name="Fname" aria-describedby="FName"  required>
        <input type="text" class="form-control" name="Mname" aria-describedby="MName">
        <input type="text" class="form-control" name="Lname" aria-describedby="LName" required>
    </div>
    <div class="form-group">
        <label class="d-block" for="Cnumber">Phone Number</label>
        <input type="text" class="form-control" name="MNumber" aria-describedby="MNumber" required>
        <input type="text" class="form-control" name="ONumber" aria-describedby="ONumber">
    </div>
    <div class="form-group">  
        <label class="d-block" for="Cemail"> E-mail: </label>
        <input type="email" name="email">
    </div>
    <div class="form-group">
        <label class="d-block" for="CCompanyName"> Company Name</label>
        <input type="text" class="form-control" name="CCompany" aria-describedby="CCompany">
    </div>
    <div class="form-group">
        <label for="inputAddress">Address</label>
        <input type="text" class="form-control" name="inputAddress">
    </div>
    <div class="form-group">
        <label for="inputAddress2">Address 2</label>
        <input type="text" class="form-control" name="inputAddress2">
    </div>
    <div class="form-row">
        <div class="form-group">
          <label for="inputCity">City</label>
          <input type="text" class="form-control" name="inputCity">
        </div>
        <div class="form-group">
          <label for="inputState">State</label>
          <select name="inputState" class="form-control">
            <option selected>Choose...</option>
            <option>Goa</option>
            <option>Banglore</option>
            <option>Maharastra</option>
            <option>Delhi</option>
          </select>
        </div>
        <div class="form-group">
          <label for="inputZip">Zip</label>
          <input type="text" class="form-control" name="zip">
        </div>
        <div class="form-group">
            <label for="inputZip">Customer Status</label>
            <input type="text" class="form-control" name="inputCustStatus">
        </div>
        <div class="form-group">
            <label for="inputZip">Customer Rating</label>
            <select id="inputCustStatus" class="form-control">
                <option selected>Choose...</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
              </select>
        </div>
        <div class="form-group"></div>
            <label for="inputZip">About Customer</label><br>
            <textarea name="CustDesc" rows="5" cols="30">
            </textarea>
        </div>
        <div class="form-group"></div>
            <label>Call Notes</label><br>
            <textarea name="CallNotes" rows="5" cols="30">
            </textarea>
        </div>
        <div class="form-group">
            <label>Customer Significance</label><br>
            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
            <label class="form-check-label" for="gridRadios1">
              Responsive
            </label>
          </div>
          <div class="form-group">
            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
            <label class="form-check-label" for="gridRadios2">
              Non-Responsive
            </label>
            </div>
            <div class="form-group">
                <label for="callScheduleTime">Next Call:</label>
                <input type="datetime-local" id="callScheduleTime" name="callScheduledaytime">
          </div>
    </div>
<br>

<input type="submit">

</form>

</body>
</html>