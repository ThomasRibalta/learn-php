<?php

$students = array();

function len_tab($array)
{
    $i = 0;
    foreach ($array as $elem)
    {
        $i++;
    }
    return $i;
}

function print_student_info($students, $name)
{
    foreach ($students as $student)
    {
        if ($student['name'] == $name || $name == "all")
        {
            echo "Name: " . $student['name'] . "\n";
            echo "Class: " . $student['class'] . "\n";
            echo "Note: ";
            foreach ($student['note'] as $note)
                echo $note . " ";
            echo "\n";
            echo "Average: " . array_sum($student['note']) / count($student['note']) . "\n\n";
            return;
        }
    }
    echo "The student doesn't exist\n\n";
}

while (TRUE)
{
    $tmp = readline("PRESS:\n1 - FOR ADD STUDENT\n2 - FOR WRITE STUDENT INFORMATION\n3 - FOR WRITE CLASS INFORMATION\n4 - FOR EXIT\n");
    if ($tmp == "1")
    {
        $student = array();
        $student['name'] = readline("Enter the student's name: ");
        $student['class'] = readline("Enter the student's class: ");
        $student['note'] = array();
        while (TRUE)
        {
            $tmpnum = (int)readline("Enter a note between 0 and 20: (-1 to stop)\n");
            if ($tmpnum == -1)
                break;
            else if ($tmpnum < 0 || $tmpnum > 20)
                echo "The note must be between 0 and 20\n";
            else
                $student['note'][] = $tmpnum;
        }
        $students[] = $student;
    }
    else if ($tmp == "2")
    {
        $name = readline("Enter the student's name: ");
        print_student_info($students, $name);
    }
    else if ($tmp == "3")
    {
        $class = readline("Enter the class: ");
        foreach ($students as $student)
        {
            if ($student['class'] == $class)
                print_student_info($students, $student['name']);
        }
    }
    else if ($tmp == "4")
        break;
}

if (len_tab($students) == 0)
    echo "The school don't have any student\n";