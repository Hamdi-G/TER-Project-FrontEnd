function findById(data, idToLookFor) {
    var Array = data;
    for (var i = 0; i < Array.length; i++) {
        if (Array[i].id == idToLookFor) {
            return(Array[i]);
        }
    }
}
