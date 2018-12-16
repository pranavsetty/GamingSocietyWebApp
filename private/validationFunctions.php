<?php

function isBlank($value)
{
    return !isset($value) || trim($value) === '';
}

// has_length_greater_thanhttps://www.quora.com/What-is-laquo-in-HTML-I-know-there-are-many-of-those-things-that-start-with-What-are-they('abcd', 3)
// * validate string length
// * spaces count towards length
// * use trim() if spaces should not count
function hasLengthGreaterThan($value, $min)
{
    $length = strlen($value);
    return $length > $min;
}

// has_length_less_than('abcd', 5)
// * validate string length
// * spaces count towards length
// * use trim() if spaces should not count
function hasLengthLessThan($value, $max)
{
    $length = strlen($value);
    return $length < $max;
}

// has_length_exactly('abcd', 4)
// * validate string length
// * spaces count towards length
// * use trim() if spaces should not count
function hasLengthExactly($value, $exact)
{
    $length = strlen($value);
    return $length == $exact;
}

// has_length('abcd', ['min' => 3, 'max' => 5])
// * validate string length
// * combines functions_greater_than, _less_than, _exactly
// * spaces count towards length
// * use trim() if spaces should not count
function hasLength($value, $options)
{
    if (isset($options['min']) && !hasLengthGreaterThan($value, $options['min'])) {
        return false;
    } elseif (isset($options['max']) && !hasLengthLessThan($value, $options['max'])) {
        return false;
    } elseif (isset($options['exact']) && !hasLengthExactly($value, $options['exact'])) {
        return false;
    } else {
        return true;
    }
}

function validateRules($rule){
  $errorsRules = [];
  $newRule = (int)$rule;
  if (isBlank($newRule)) {
      $errorsRules['value'] = "Rule cannot be blank.";
  } elseif ($newRule <= 0) {
      $errorsRules['value'] = "Rule must be a number and greater than zero.";
  }
  return $errorsRules;
}

function validateGame($game)
{
    $errors = [];
    //name
    if (isBlank($game['name'])) {
        $errors['name'] = "Name cannot be blank.";
    } elseif (!hasLength($game['name'], ['min' => 2, 'max' => 255])) {
        $errors['name'] = "Name must be between 2 and 255 characters.";
    }
    $cost_int = (int)$game['cost'];
    if (isBlank($game['cost'])) {
        $errors['cost'] = "Cost cannot be blank.";
    } elseif ($cost_int <= 0) {
        $errors['cost'] = "Cost must be a number and greater than zero.";
    }

    $age_limit = (int)$game['ageLimit'];
    if (isBlank($game['ageLimit'])) {
        $errors['ageLimit'] = "Age Limit cannot be blank";
    } elseif ($age_limit <= 0) {
        $errors['ageLimit'] = "Age must be a positive number";
    }
    $release_year = (int)$game['releaseYear'];
    if ($release_year <= 1950) {
        $errors['releaseYear'] = "Must be a valid year";
    }
    if (isBlank($game['imageLink'])) {
        $errors['imageLink'] = "There must be an image link";
    } elseif (!hasLength($game['imageLink'], ['max' => 5000])) {
        $errors['imageLink'] = "Image Link must be below 5000 characters";
    }
    if (!hasLength($game['gameDescription'], ['max' => 5000])) {
        $errors['gameDescription'] = "Game Description must be below 5000 characters";
    }
    return $errors;
}

function validateDebt($member){
    $errorsMembers = [];
    $debt_int = (int)$member['debt'];
    if(isBlank($member['debt'])){
        $errorsMembers['debt'] = "Debt cannot be blank";

    }elseif ($debt_int < 0){
        $errorsMembers['debt'] = "Debt must be a positive number";
    }elseif ($debt_int > $member['debt']){
        $errorsMembers['debt'] ="Debt cannot be greater than the original value";
    }
    return $errorsMembers;

}

function validateTitle($title)
{
    return $title == "Sir" || "Mr" || "Mrs" || "Ms" || "Miss" || "Mx" || "Sir" || "Lord" || "Lady";
}

?>
