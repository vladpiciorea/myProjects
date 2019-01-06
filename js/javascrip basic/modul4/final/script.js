class Conatac {
    constructor(name, email){
        this.name = name;
        this.email = email;
        }
        add(contact){
            this.listOfContacts.push(contact);
        }
        remove(contact){
            for(let i=0; i < this.listOfContacts.lenght;i++){

                var c = this.listOfContacts[i];
                if(c.email === contact.email){
                    this.listOfContacts.splice(i,i);
                    break;
                }
            }
        }
        printContactsToConsole() {
            this.listOfContacts.forEach(function(c) {
                console.log(c.name);
            });
}
var c1 = new Conatac("Jimi Hendrix", "jimi@rip.com");
var c2 = new Conatac("Robert Fripp","robert.fripp2kimgcrimson.cam");


