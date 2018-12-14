<?php

function is_blank($value)
{
    return !isset($value) || trim($value) === '';
}

function has_presence($value)
{
    return !is_blank($value);
}

// has_length_greater_thanhttps://www.quora.com/What-is-laquo-in-HTML-I-know-there-are-many-of-those-things-that-start-with-What-are-they('abcd', 3)
// * validate string length
// * spaces count towards length
// * use trim() if spaces should not count
function has_length_greater_than($value, $min)
{
    $length = strlen($value);
    return $length > $min;
}

// has_length_less_than('abcd', 5)
// * validate string length
// * spaces count towards length
// * use trim() if spaces should not count
function has_length_less_than($value, $max)
{
    $length = strlen($value);
    return $length < $max;
}

// has_length_exactly('abcd', 4)
// * validate string length
// * spaces count towards length
// * use trim() if spaces should not count
function has_length_exactly($value, $exact)
{
    $length = strlen($value);
    return $length == $exact;
}

// has_length('abcd', ['min' => 3, 'max' => 5])
// * validate string length
// * combines functions_greater_than, _less_than, _exactly
// * spaces count towards length
// * use trim() if spaces should not count
function has_length($value, $options)
{
    if (isset($options['min']) && !has_length_greater_than($value, $options['min'])) {
        return false;
    } elseif (isset($options['max']) && !has_length_less_than($value, $options['max'])) {
        return false;
    } elseif (isset($options['exact']) && !has_length_exactly($value, $options['exact'])) {
        return false;
    } else {
        return true;
    }
}

// has_inclusion_of( 5, [1,3,5,7,9] )
// * validate inclusion in a set
function has_inclusion_of($value, $set)
{
    return in_array($value, $set);
}

// has_exclusion_of( 5, [1,3,5,7,9] )
// * validate exclusion from a set
function has_exclusion_of($value, $set)
{
    return !in_array($value, $set);
}

// has_string('nobody@nowhere.com', '.com')
// * validate inclusion of character(s)
// * strpos returns string start position or false
// * uses !== to prevent position 0 from being considered false
// * strpos is faster than preg_match()
function has_string($value, $required_string)
{
    return strpos($value, $required_string) !== false;
}

// has_valid_email_format('nobody@nowhere.com')
// * validate correct format for email addresses
// * format: [chars]@[chars].[2+ letters]
// * preg_match is helpful, uses a regular expression
//    returns 1 for a match, 0 for no match
//    http://php.net/manual/en/function.preg-match.php
function has_valid_email_format($value)
{
    $email_regex = '/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i';
    return preg_match($email_regex, $value) === 1;
}

//Don't really need it as boostrap already checks all this.
function validate_member($member)
{
    $errors = [];

    // menu_name
    if (is_blank($member['Fname'])) {
        $errors[] = "Name cannot be blank.";
    } elseif (!has_length($member['FName'], ['min' => 2, 'max' => 255])) {
        $errors[] = "Name must be between 2 and 255 characters.";
    }

    // position
    // Make sure we are working with an integer
    $postion_int = (int)$member['position'];
    if ($postion_int <= 0) {
        $errors[] = "Position must be greater than zero.";
    }
    if ($postion_int > 999) {
        $errors[] = "Position must be less than 999.";
    }

    // visible
    // Make sure we are working with a string
    $visible_str = (string)$member['visible'];
    if (!has_inclusion_of($visible_str, ["0", "1"])) {
        $errors[] = "Visible must be true or false.";
    }

    return $errors;
}


function validate_rules($rule){
  $errorsRules = [];
  $newRule = (int)$rule;
  if (is_blank($newRule)) {
      $errorsRules['value'] = "Rule cannot be blank.";
  } elseif ($newRule <= 0) {
      $errorsRules['value'] = "Rule must be a number and greater than zero.";
  }
  return $errorsRules;
}

function validate_game($game)
{
    $errors = [];

    //name
    if (is_blank($game['name'])) {
        $errors['name'] = "Name cannot be blank.";
    } elseif (!has_length($game['name'], ['min' => 2, 'max' => 255])) {
        $errors['name'] = "Name must be between 2 and 255 characters.";
    }
    $cost_int = (int)$game['cost'];
    if (is_blank($game['cost'])) {
        $errors['cost'] = "Cost cannot be blank.";
    } elseif ($cost_int <= 0) {
        $errors['cost'] = "Cost must be a number and greater than zero.";
    }

    $age_limit = (int)$game['ageLimit'];
    if (is_blank($game['ageLimit'])) {
        $errors['ageLimit'] = "Age Limit cannot be blank";
    } elseif ($age_limit <= 0) {
        $errors['ageLimit'] = "Age must be a positive number";
    }
    $currently_available = (string)$game['isCurrentlyAvailable'];
    if (!has_inclusion_of($currently_available, ["0", "1"])) {
        $errors['isCurrentlyAvailable'] = "Currently Available either be 0 or 1";
    }
    $release_year = (int)$game['releaseYear'];
    if ($release_year <= 1950) {
        $errors['releaseYear'] = "Must be a valid year";
    }
    if (is_blank($game['imageLink'])) {
        $errors['imageLink'] = "There must be an image link";
    } elseif (!has_length($game['imageLink'], ['max' => 5000])) {
        $errors['imageLink'] = "Image Link must be below 5000 characters";
    }
    if (!has_length($game['gameDescription'], ['max' => 5000])) {
        $errors['gameDescription'] = "Game Description must be below 5000 characters";
    }
    return $errors;
}

function validate_debt($member){
    $errorsMembers = [];
    $debt_int = (int)$member['debt'];
    if(is_blank($member['debt'])){
        $errorsMembers['debt'] = "Debt cannot be blank";

    }elseif ($debt_int < 0){
        $errorsMembers['debt'] = "Debt must be a positive number";
    }elseif ($debt_int > $member['debt']){
        $errorsMembers['debt'] ="Debt cannot be greater than the original value";
    }
    return $errorsMembers;

}

function checkIfCorrectTitle($title)
{
    return $title == "Sir" || "Mr" || "Mrs" || "Ms" || "Miss" || "Mx" || "Sir" || "Lord" || "Lady";
}

?>
