import React, { useState } from "react";
import { Row, Col, FormControl, Button, Image, Spinner, Container } from "react-bootstrap";
import statics from "../../statics.json";
import { Formik } from "formik";
import ErrorMessage from "../components/ErrorMessage";
import { logInSchema } from "../../global/validations";
import { setCookie } from "../../global/cookie";
import { setToken, setProfileData } from "../../redux/actions/profile";
import { setRelogIn } from "../../redux/actions/reLogIn";
import { useDispatch } from "react-redux";
import { login } from "./../../requests/Authorization";
import { requestHandeler } from "../../global/requestHandeler";
import { FaGoogle } from 'react-icons/fa';

const LogIn = ({ relogin = false, showHideMethod = null }) => {
    const dispatch = useDispatch();
    const [error, setError] = useState({ status: false, meessage: "" });
    const [requesting, setRequesting] = useState(false);

    const handelSubmit = async (values) => {
        setError({ status: false, meessage: "" });
        setRequesting(true);

        requestHandeler(
            login({ username: values.email, password: values.password }),
            async (respons) => {
                setCookie(30, "token", respons.data.token);
                await dispatch(setToken(respons.data.token));
                await dispatch(setProfileData(respons.data.informations));
                setRequesting(false);
                if (relogin) {
                    await dispatch(setRelogIn(false));
                }
                setTimeout(() => {
                    // dispatch(setRelogIn(true));
                }, 5000);
            },
            (respons) => {
                setRequesting(false);
                setError({
                    status: true,
                    meessage: respons.data.message,
                });
            },
            (error) => {
                console.log(error);
                setRequesting(false);
                setError({ status: true, meessage: error + "" });
            }
        );
    };

    return (
        <Container fluid="true">
            <Row
                className={
                    relogin
                        ? "align-items-center justify-content-center"
                        : "vh-100 align-items-center justify-content-center g-0"
                }
            >
                <Col
                    xs="12"
                    sm={relogin ? "auto" : "6"}
                    md={relogin ? "10" : "4"}
                    xxl="auto"
                    className="logInCard d-flex flex-column primary_light_dark justify-content-center align-items-center"
                >
                    <Image
                        className="mb-4"
                        src={statics.logo_url}
                        rounded
                        fluid
                        style={{ width: "300px" }}
                    />
                    <Col lg="12" className="text-center">
                        <Formik
                            initialValues={{ email: "", password: "" }}
                            onSubmit={(values) => handelSubmit(values)}
                            validationSchema={logInSchema}
                        >
                            {({
                                handleBlur,
                                handleChange,
                                handleSubmit,
                                errors,
                                touched,
                            }) => (
                                <>
                                    <FormControl
                                        name="email"
                                        className="login_input mb-1"
                                        placeholder="Email"
                                        aria-label="Recipient's username"
                                        aria-describedby="basic-addon2"
                                        onChange={handleChange("email")}
                                        onBlur={handleBlur("email")}
                                    />
                                    <ErrorMessage
                                        error={errors.email}
                                        touched={touched.email}
                                        className="mb-3"
                                    />
                                    <FormControl
                                        name="password"
                                        className="login_input mb-1"
                                        placeholder="Password"
                                        aria-label="Recipient's username"
                                        aria-describedby="basic-addon2"
                                        onChange={handleChange("password")}
                                        onBlur={handleBlur("password")}
                                        type='password'
                                    />
                                    <ErrorMessage
                                        error={errors.password}
                                        touched={touched.password}
                                        className="mb-3"
                                    />
                                    <ErrorMessage
                                        error={error.meessage}
                                        touched={error.status}
                                        className="mb-3"
                                    />
                                    <Row className="g-0">
                                        <Button
                                            className={requesting ? "mb-2" : "mb-2"}
                                            variant="danger"
                                            onClick={() => {
                                                !requesting && handleSubmit();
                                            }}
                                        >
                                            {requesting ? (
                                                <Spinner
                                                    size="sm"
                                                    animation="border"
                                                    variant="primary"
                                                />
                                            ) : (
                                                <span>وارد شوید</span>
                                            )}
                                        </Button>
                                        <Button className="mb-2" variant="primary">
                                            <FaGoogle />
                                        </Button>
                                    </Row>
                                </>
                            )}
                        </Formik>
                    </Col>
                </Col>
            </Row>
        </Container>
    );
};

export default LogIn;
