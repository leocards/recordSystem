/* 
    checking is the array existed
*/
export const __array_exist = (val) => {
    if(!val) return false
}

/* 
    checks if the array meets the condition.
    val = the value to check
    consdition = the condition to use for checking
    number = the number to use for comparison
*/
export const __conditioned_array = (val, condition, number) => {
    __array_exist(val)
    
    // check first if the val is an array
    if (Array.isArray(val)) {
        if (condition == ">") {
            return parseFloat(val.length) > parseFloat(number)
        } else if (condition == "<") {
            return parseFloat(val.length) < parseFloat(number)
        } else if (condition == "==") {
            return parseFloat(val.length) == parseFloat(number)
        } else if (condition == "<=") {
            return parseFloat(val.length) <= parseFloat(number)
        } else if (condition == ">=") {
            return parseFloat(val.length) >= parseFloat(number)
        } else return false;
    } else return false;
};