/* 
    element = the clicked element to check if it has the specified attribute ex. data-button
    attributes = the ettributes to check
    cb = a callback method
    current = if the user have opened a repository, then get the current repository
    cd2 = a callback function
*/
export const handleClickElement = (element, attributes, cb, current = null, cb2 = null) => {
    // check if the user have opened a directory and clicked an element, and of the element 
    // has a attribute present
    if(current && !attributes.some(attribute => element.target.hasAttribute(attribute))) {
        if(cb2) {
            cb2()
        }
    }
    // clicks if an element has the specfifed attribute attribute present
    else if (!attributes.some(attribute => element.target.hasAttribute(attribute))) {
        cb()
    } 
};

// Observing the element if it resized
export const resizedElement = (element = null, cb) => {
    let resize = new ResizeObserver(() => {
        cb()
    });
    
    // checks if the element exist, then call the resize
    element ? resize.observe(element) : ''
}

// checking if the user opens the application in the mobile browser
export const isMobile = () => {
    return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
        navigator.userAgent
    );
};