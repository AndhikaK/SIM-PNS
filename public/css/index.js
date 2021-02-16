// Cara untuk membuat object pada Javascript
// Object literal
let mhs = {
    nama : 'Andhika',
    hp : 100000,
    makan : function(hp) {
      this.hp = this.hp + hp;
      console.log(`Your hp is ${this.hp}`)
    }
  };
  UIkit.notification({message: 'Danger message...', status: 'danger'})
  alert('fsdaf')
  
  console.log('dfasf')
  
  // function declaration
  // function Mhs (nama, hp) {
  //     let mahasiswa = {};
  
  //     mahasiswa.nama = nama;
  //     mahasiswa.hp = hp;
  
  //     mahasiswa.makan = function (hp) {
  //         this.hp = this.hp + hp;
  //         console.log(`${nama} hp is ${this.hp}`);
  //     }
  
  //     return mahasiswa;
  // };
  
  
  // constructor function
  // keyword new 
  function Mhs (nama, hp) {
      this.nama = nama;
      this.hp = hp;
  
      this.makan = function (hp) {
          this.hp = this.hp + hp;
          console.log(`${nama} hp is ${this.hp}`);
      }
  };
  
  let andhika = new Mhs('andhika', 2000);