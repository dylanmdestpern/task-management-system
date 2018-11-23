<link rel="stylesheet" href="css/newTaskForm.css">

<form>
    <div style="width: 100%; cursor: pointer;" data-toggle="collapse" data-target="#newTaskCollapsed">
        <h3>New task</h3>
    </div>

    <div id="newTaskCollapsed" class="collapse" style="border: 1px solid #AAA; padding: 10px;">
        <in put type="text" style="width: 100%; padding: 10px; border: 1px solid #AAA; font-size: 20px" placeholder="Name">
        <label for="newTaskTextArea">Description</label>
        <textarea id="newTaskTextArea"></textarea>
        
        <div style="width: 100%; text-align: right; margin-top: 10px;">
            <button class="btn btn-primary">Create</button>
        </div>

        <form>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        
    </div>


    <script type="text/javascript" src="js/taskForm.js"></script>
</form>
