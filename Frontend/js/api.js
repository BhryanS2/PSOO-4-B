class API {
  constructor() {
    this.url = "../../Backend";
    this.user = {};
    this.routes = {
      login: {
        method: "POST",
        route: `${this.url}/login`,
      },
      register: {
        method: "POST",
        route: `${this.url}/signup`,
      },
      delete: {
        method: "POST",
        route: `${this.url}/delete`,
      },
      getAll: {
        method: "GET",
        route: `${this.url}/getall`,
      },
    };
  }
  async login({ email = "", password = "" }) {
    const res = await fetch(`${this.routes.login.route}`, {
      method: this.routes.login.method,
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        email,
        password,
      }),
      cors: "no-cors",
    });
    if (res.status) {
      this.setUser(res);
      return res.json();
    }
  }
  async register({ email = "", password = "", name = "" }) {
    const res = await fetch(`${this.routes.register.route}`, {
      method: this.routes.register.method,
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        email,
        password,
        name,
      }),
      cors: "no-cors",
    });
    if (res.status) {
      this.setUser(res);
      return res.json();
    }
  }
  getUser() {
    this.user = JSON.parse(localStorage.getItem("user"));
    return this.user;
  }
  setUser(user) {
    this.user = user;
    localStorage.setItem("user", JSON.stringify(user));
  }
  logout() {
    this.user = {};
    localStorage.removeItem("user");
  }
}
