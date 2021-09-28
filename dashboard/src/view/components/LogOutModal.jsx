import { Modal } from "react-bootstrap";
import { Container, Button } from "react-bootstrap";
import { requestHandeler } from "../../global/requestHandeler";
import { LogOut } from "./../../requests/Authorization";
import { useSelector, useDispatch } from 'react-redux';
import { setCookie } from "../../global/cookie";
import { setToken, setProfileData } from "../../redux/actions/profile";
import statics from "../../statics.json";

const LogOutModal = ({ show, close, history }) => {

    const token = useSelector((state) => state.token);
    const dispatch = useDispatch();

    const handelLogOut = () => {
        requestHandeler(
            LogOut({ token }),
            async (respons) => {
                setCookie(-1, "token", null);
                await dispatch(setToken(null));
                await dispatch(setProfileData(null));
            },
            (respons) => {
                history.replace(statics.web_url);
            },
            (error) => {
                console.log(error);
            }
        );
    };

    return (
        <Modal
            show={show}
            aria-labelledby="contained-modal-title-vcenter"
            centered
            dialogClassName="modal-coustom"
            backdrop="static"
            keyboard={false}
        >
            <Modal.Body className="show-grid">
                <Container fluid="true" style={{ backgroundColor: 'transparent' }}>
                    آیا میخواهید از حساب کاربری خود خارج شوید ؟
                </Container>
            </Modal.Body>
            <Modal.Footer style={{ justifyContent: "center" }}>
                <Button variant="secondary" onClick={close}>
                    انصراف
                </Button>
                <Button variant="primary" onClick={handelLogOut} >
                    خروج
                </Button>
            </Modal.Footer>
        </Modal>
    );
}
export default LogOutModal;
