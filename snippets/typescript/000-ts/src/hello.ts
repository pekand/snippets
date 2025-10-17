export class Hello {
  constructor(private name: string) {}

  sayHi() {
    console.log(`Ahoj ${this.name}!`);
  }
}