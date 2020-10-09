export default class Gate{

    constructor(user){
        this.user = user;
    }

    isAdmin(){
        return this.user.type === 'admin';
    }
    isKorcam(){
        return this.user.type === 'korcam';
    }
    isKordes(){
        return this.user.type === 'kordes';
    }
    isUser(){
        return this.user.type === 'user';
    }
    
    isAdminOrUser(){
        if(this.user.type === 'user' || this.user.type === 'admin'){
            return true;
        }
    }
}

