/* 
    checks if the array meets the condition.
    val = the value to check
    consdition = the condition to use for checking
    number = the number to use for comparison
*/
export const __conditioned_array = (array, condition, number) => {
    try {
        if(!array) throw 'array must not be empty.'
        if(typeof condition !== 'string') throw 'condition must be a type of string, "'+ (typeof condition) + '" given.'
        if(typeof number !== 'number') throw 'number must be a type of number, "'+ (typeof number) + '" given.'
    
        // check first if the array is an array
        if (Array.isArray(array)) {

            if (condition == ">")
                return parseFloat(array.length) > parseFloat(number)
            else if (condition == "<")
                return parseFloat(array.length) < parseFloat(number)
            else if (condition == "==")
                return parseFloat(array.length) == parseFloat(number)
            else if (condition == "<=")
                return parseFloat(array.length) <= parseFloat(number)
            else if (condition == ">=")
                return parseFloat(array.length) >= parseFloat(number)
            else return false;

        } else
            throw 'array must be a type of array, "'+ (typeof array) + '" given.'
        
    } catch (e) {
        console.error(e)
    }
};

export const __compare_index_array = (index, condition, number) => {
    try {
        if(typeof index !== 'number') throw 'index must be a type of number, "'+ (typeof index) + '" given.'
        if(typeof condition !== 'string') throw 'condition must be a type of string, "'+ (typeof condition) + '" given.'
        if(typeof number !== 'number') throw 'number must be a type of number, "'+ (typeof number) + '" given.'

        let conditions = ['>','<','>=','<=','==','===']

        if(!conditions.includes(condition)) throw conditions + ' is not a valid condition.'
    
        if (condition == ">")
            return number > index
        else if (condition == "<")
            return number < index
        else if (condition == "==")
            return number == index
        else if (condition == "<=")
            return number <= index
        else if (condition == ">=")
            return number >= index
        else if (condition == "===")
            return number === index
        else return false;

    } catch (e) {
        console.error(e)
    }
}