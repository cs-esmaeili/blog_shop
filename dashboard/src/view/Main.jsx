import { Container } from "react-bootstrap";
import { useSelector, useDispatch } from "react-redux";
import { getCookie } from "../global/cookie";
import { setToken } from "../redux/actions/profile";
import LogIn from "./pages/LogIn";
import { Button } from "react-bootstrap";
import LogInModal from "./components/LogInModal";
import { useState } from "react";

const Main = () => {
    const token = useSelector((state) => state.token);
    const dispatch = useDispatch();

    if (token === null && getCookie("token") !== null) {
        dispatch(setToken(getCookie("token")));
    }

    return (
        <Container fluid="true">
            {getCookie("token") === null ? (
                <LogIn />
            ) : (
                <>
                    <div className="test">salam</div>
                    <div className="test">salam</div>
                    <div className="test">salam</div>
                    <div className="test">salam</div>
                    <div className="test">salam</div>
                    <div className="test">salam</div>
                    <div className="test">salam</div>
                    <div className="test">salam</div>
                    <div className="test">salam</div>
                    <div>{token}</div>
                    <LogInModal />
                </>
            )}
        </Container>
    );
};

export default Main;
