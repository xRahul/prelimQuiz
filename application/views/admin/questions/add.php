<div class="container">
    <div class="row" style="margin-top: 50px">
        <div class="col-md-6 offset-md-3">
            <hr />
            <h4 style="text-align: center">Add Question</h4>
            <hr />
            <label for="question_type">Type of the Question</label>
            <select class="form-control" name="quesion_type" id="question_type">
                <option value="" selected></option>
                <option value="mcq">MCQ</option>
                <option value="general">General</option>
            </select>
            <form name="mcq" id="mcq" role="form" method="POST" action="" style="display:none">
                <hr />
                <h4 style="text-align: center">Multiple Choice Question</h4>
                <hr />
                <div class="form-group">
                    <label class="control-label" for="question_statement">Statement:</label>
                    <input type="text" class="form-control" name="question_statement" id="question_statement" placeholder="Statement of the Question">
                </div>
                <div class="form-group">
                    <label class="control-label" for="option_a">Option A: </label>
                    <input type="text" class="form-control" name="option_a" id="option_a" placeholder="First Option">
                </div>
                <div class="form-group">
                    <label class="control-label" for="option_b">Option B: </label>
                    <input type="text" class="form-control" name="option_b" id="option_b" placeholder="Second Option">
                </div>
                <div class="form-group">
                    <label class="control-label" for="option_c">Option C: </label>
                    <input type="text" class="form-control" name="option_c" id="option_c" placeholder="Third Option">
                </div>
                <div class="form-group">
                    <label class="control-label" for="option_d">Option D: </label>
                    <input type="text" class="form-control" name="option_d" id="option_d" placeholder="Fourth Option">
                </div>
                <label for="answer">Answer: </label>
                <select class="form-control" name="answer" id="answer">
                    <option value="" selected disabled>Choose Answer: </option>
                    <option value="a">A</option>
                    <option value="b">B</option>
                    <option value="c">C</option>
                    <option value="d">D</option>
                </select>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>

            <form name="general" id="general" role="form" method="POST" action="" style="display:none">
                <hr />
                <h4 style="text-align: center">General Question</h4>
                <hr />
                <div class="form-group">
                    <label class="control-label" for="question_title">Statement:</label>
                    <input type="text" class="form-control" name="question_statement" id="question_statement" placeholder="Statement of the Question">
                </div>
                <div class="form-group">
                    <label class="control-label" for="answer">Answer: </label>
                    <input type="text" class="form-control" name="answer" id="answer" placeholder="Answer">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>

        </div>
    </div>
</div>

