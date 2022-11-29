const openModal = (id) => {
  const modal = document.querySelector(`#${id}`);
  modal.style.display = "flex";
};

const closeModal = (id) => {
  const modal = document.querySelector(`#${id}`);
  modal.style.display = "none";
};

const openRegisterModal = () => {
  closeModal("login");
  openModal("register-modal");
};
