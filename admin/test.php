<!-- Modal Task Create-->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered text-center d-flex justify-content-center modal-xl">
                <div class="modal-content w-75">
                    <div class="modal-body p-4">
                    <h2 class='card-title mb-3'>Create Task</h2>
                    <form method = "post" action="task-create.php?assign=<?php if(!empty($_GET['assign'])){echo $_GET['assign'];}?>">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Title</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" name="title" required/>
                                <div id="emailHelp" class="form-text">
                                    Brief intro about the task. (eg Carpenter & Paintjob)
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Location</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" name="location" required/>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Salary Rate(Php)</label>
                                <input type="number" class="form-control" id="exampleInputPassword1" name="rate" required/>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Description</label>
                                <textarea type="text" class="form-control" id="exampleInputPassword1" rows="4" name="description" required></textarea>
                            </div>
                            <div class="row justify-content-center">
                                <div>Category</div>
                                <p id="emailHelp" class="form-text">
                                    Select category that applies.
                                </p>
                                <div>
                                    <ul class="ks-cboxtags" style="padding-top:0;">
                                        <li>
                                            <input type="checkbox" class='acb' id="checkboxCar" value="Carpenter" name="category[]" onclick='deRequire("acb")' required>
                                            <label for="checkboxCar">Carpenter</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" class='acb' id="checkboxPlum" value="Plumber" name="category[]" onclick='deRequire("acb")' required>
                                            <label for="checkboxPlum">Plumber</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" class='acb' id="checkboxPaint" value="Painter" name="category[]" onclick='deRequire("acb")' required>
                                            <label for="checkboxPaint">Painter</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" class='acb' id="checkboxElec" value="Electrician" name="category[]" onclick='deRequire("acb")' required>
                                            <label for="checkboxElec">Electrician</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" class='acb' id="checkboxDriv" value="Driver" name="category[]" onclick='deRequire("acb")' required>
                                            <label for="checkboxDriv">Driver</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" class='acb' id="checkboxWeld" value="Welder" name="category[]" onclick='deRequire("acb")' required>
                                            <label for="checkboxWeld">Welder</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" class='acb' id="checkboxHouse" value="House Keeper" name="category[]" onclick='deRequire("acb")' required>
                                            <label for="checkboxHouse">House Keeper</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" class='acb' id="checkboxGlass" value="Glass Worker" name="category[]" onclick='deRequire("acb")' required>
                                            <label for="checkboxGlass">Glass Worker</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" class='acb' id="checkboxMid" value="Midwife" name="category[]" onclick='deRequire("acb")' required>
                                            <label for="checkboxMid">Midwife</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="text-center"><button type="submit" class="btn btn-primary" name="submit">Submit</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>