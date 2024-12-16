<span id="question_html_1_1">
    <p> </p>
    <p> <?php echo $row_question->question; ?></p>
    <p></p>
</span>
<?php if ($row_question->question_type == "ParagraphTypeQuestion") { ?>
    <p id="html_ans_type_1_1">Answer Type: Paragraph type answer</p>
<?php } else if ($row_question->ans_type == "mcqs") { ?>
    <p id="html_ans_type_1_1">Answer Type: Single choice is correct</p>
    <p id="correct_ans_html_1_1">Correct Answer: <?php echo $row_question->radio_correct_ans; ?>
        (<?php
        if ($row_question->radio_correct_ans != null || $row_question->radio_correct_ans != "") {
            $ans = "radio_ans_" . $row_question->radio_correct_ans;
            echo strip_tags($row_question->$ans);
        }
        ?>)
    </p>
<?php } else if ($row_question->ans_type == "mcqm") { ?>
    <p id="html_ans_type_1_1">Answer Type: MCQ (More than one is correct)</p>
    <?php
    $correct_ans_chkArray = explode(',', $row_question->correct_ans_chk);
    foreach ($correct_ans_chkArray as $_correct_ans_chkArray) {
        ?>
        <p id="correct_ans_html_1_1">Correct Answer: <?php echo strtoupper($_correct_ans_chkArray); ?>
            (<?php
            $ans = "chk_multi_answer_" . $_correct_ans_chkArray;
            //echo $ans;
            echo strip_tags($row_question->$ans);
            ?>)
        </p>
    <?php } ?>
<?php } else { ?>
    <p id="html_ans_type_1_1">Answer Type: Fill in the blank/Numerical answer</p>
    <p id="correct_ans_html_1_1">Correct Answer: <?php echo $row_question->correct_ans_fill; ?>

    </p>
<?php } ?>
<?php if ($row_question->question_type != "ParagraphTypeQuestion") { ?>
    <p id="correct_mark_html_1_1">Correct Marking: <?php echo $row_question->marking_correct; ?>; Incorrect Marking: <?php echo $row_question->marking_incorrect; ?></p>
<?php } ?>