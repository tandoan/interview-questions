for(var i=0; i<10; i++){
    setTimeout(function(){
        console.log(i);
    }, i*1000);
}

/** 
Output: with proper delays
10
10
10
10
10
10
10
10
10
10
*/

for(var i=0; i<10; i++){
    (function(){
        var t = i;
        setTimeout(function(){
            console.log(t);
        }, i*1000);
    })();
    
}

/** 
Output: with proper delays
0
1
2
3
4
5
6
7
8
9
*/


for(var i=0; i<10; i++){

    setTimeout(function(){
        console.log(i);
    }.call(this, [i]), i*1000);    
}
/** 
Output: with no delays
0
1
2
3
4
5
6
7
8
9
*/

