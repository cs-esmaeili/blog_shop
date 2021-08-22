import * as Yup from "yup";

export const logInSchema = Yup.object().shape({
    email: Yup.string()
        .required("این فیلد الزامی می باشد")
        .email("ایمیل معتبر نمی باشد"),
    password: Yup.string()
        .min(5, "رمز عبور باید بیشتر از 5 کارکتر باشد")
        .required("این فیلد الزامی می باشد"),
});
