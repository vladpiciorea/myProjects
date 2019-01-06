let array = ['red','blue','yello','purple'];

//pentru a adauga un element
array.push('orange');
array[array.length] = 'green';

//pentru a stege un element sperge 1 element de la ndexul 2 yello
array.splice(2,1);
//sterge primele 3 elemente
array.splice(0,3);
//sterge ultimul element
array.pop();

//pentru a sorta , sorteaza in ordine alfabetica
array.sort();

let person = [
    {giveName: 'vlad', familyName:'Piciorea',age:'23'},
    {giveName: 'Stefan', familyName:'Bichiu',age:'22'},
    {giveName: 'Budi', familyName:'Priaskana',age:'28'}
];
function compareByAge(a,b){
    if(a.age < b.age)
    return -1;
    if(a.age > b.age)
    return 1;
    return 0;
}
//sortare dupa nume
person.sort(compareByAge);
//remouve ultiumul element
person.pop();
//remouve un element, elementul care este la index 0 si este primul , 1 inseamna un element nu 2
person.splice(0,1);

var array2X = [ [1,2,3], [4,5,6]];
//primul rand [1,2,3]
array2X[0];
//al doilea rand [4,5,6]
array2X[1];
//primul element din primul rand
array2X[0][0];

 var s = 'Michel';
 var s2 ='Buffa';

 //sterge ultimul element adica 'l'
 s = s.substring(0,s.length-1);

 //adauga o var la alta

 var s3 = s.concat(s2);
  //stergerea unui numar de cracatere
   function remouveChar(s,startIndex,numberOfChar) {
       return s.substring(0,startIndex) 
            + s.substring(startIndex+numberOfChar);
       }
    var snew = remouveChar(s,1,3);
    //pentru a adauga un numar de caractere
    function replaceAt(s, index, character) {
        return s.substr(0, index) 
                + character
                + s.substr(index+character.length);
    }

    let ayy = ['Monday', 'Tuesday', 'Wednesday'];


ayy.forEach(function(day, index, arr) {
  // day will be the current day
  document.body.innerHTML += day + " is at index: " + index + " from an array of " + arr.length + " elements!<br>";
});
for(let i = 0; i < a.length; i+=2) {
    document.body.innerHTML += a[i] + "<br>";
  }
  