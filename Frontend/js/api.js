export class API {
  constructor() {
    this.url = "http://localhost/Luisa/Backend/index.php?route="; // Trocar quando subir para o infinity
    this.user = {};
    this.routes = {
      login: {
        method: "POST",
        route: `${this.url}login`,
      },
      register: {
        method: "POST",
        route: `${this.url}signup`,
      },
      delete: {
        method: "POST",
        route: `${this.url}delete`,
      },
      getAll: {
        method: "GET",
        route: `${this.url}getall`,
      },
      question: {
        method: {
          // "POST" | "GET" | "DELETE"
          post: "POST",
          get: "GET",
          delete: "DELETE",
        },
        route: `${this.url}question`,
      },
      answer: {
        method: {
          post: "POST",
          get: "GET",
        },
        route: `${this.url}answer`,
      },
      lesson: {
        method: {
          post: "POST",
          get: "GET",
        },
        route: `${this.url}lesson`,
      },
      questions: {
        method: "GET",
        route: `${this.url}question-getall`,
      },
      answers: {
        method: "GET",
        route: `${this.url}answer-getall`,
      },
      lessons: {
        method: "GET",
        route: `${this.url}lesson-getall`,
      },
    };
  }
  async login({ email = "", password = "" }) {
    const res = await fetch(`${this.routes.login.route}`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        email,
        password,
      }),
      cors: "cors",
    });
    const data = await res.json();
    if (data.status) {
      this.setUser(data.data);
      return data;
    }
    return data;
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
    const data = await res.json();
    if (data.status) {
      this.setUser(data.data);
      return data;
    }
    return data;
  }
  async getAllQuestions() {
    const res = await fetch(`${this.routes.questions.route}`, {
      method: this.routes.questions.method,
      headers: {
        "Content-Type": "application/json",
      },
    });
    const data = await res.json();
    console.log(data);
    return data.data;
  }

  async getAllAnswers() {
    const res = await fetch(`${this.routes.answers.route}`, {
      method: this.routes.answers.method,
      headers: {
        "Content-Type": "application/json",
      },
    });
    const data = await res.json();
    return data;
  }

  async getAllLessons() {
    const res = await fetch(`${this.routes.lessons.route}`, {
      method: this.routes.lessons.method,
      headers: {
        "Content-Type": "application/json",
      },
    });
    const data = await res.json();
    return data;
  }

  async getQuestion(id) {
    const res = await fetch(`${this.routes.question.route}&id=${id}`, {
      method: this.routes.question.method,
      headers: {
        "Content-Type": "application/json",
      },
    });
    const data = await res.json();
    return data;
  }

  async getAnswer(id) {
    const res = await fetch(`${this.routes.answer.route}&id=${id}`, {
      method: this.routes.answer.method,
      headers: {
        "Content-Type": "application/json",
      },
    });
    const data = await res.json();
    return data;
  }

  async getLesson(id) {
    const res = await fetch(`${this.routes.lesson.route}&id=${id}`, {
      method: this.routes.lesson.method,
      headers: {
        "Content-Type": "application/json",
      },
    });
    const data = await res.json();
    return data;
  }

  async deleteQuestion(id) {
    const res = await fetch(`${this.routes.question.route}`, {
      method: this.routes.question.method,
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        id,
      }),
    });
    const data = await res.json();
    return data;
  }

  async submitAnswer({ answerId, questionId }) {
    const user = this.getUser();
    const userId = Number(user.id);
    const alternativeId = Number(answerId);

    const res = await fetch(`${this.routes.answer.route}`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        userId,
        alternativeId,
        questionId,
      }),
    });
    const data = await res.json();
    console.log(data);
    return data;
  }

  getUser() {
    this.user = JSON.parse(localStorage.getItem("user"));
    return this.user;
  }
  setUser(user) {
    this.user = user;

    localStorage.setItem("user", JSON.stringify(user));
  }
  signOut() {
    this.user = {};
    localStorage.removeItem("user");
  }
}
