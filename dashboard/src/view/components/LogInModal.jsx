import { Modal } from "react-bootstrap";
import LogIn from "../pages/LogIn";
import { Container } from "react-bootstrap";
import { useSelector } from "react-redux";
const LogInModal = () => {

    const reLogIn = useSelector((state) => state.reLogIn);

    return (
        <Modal
            show={reLogIn}
            aria-labelledby="contained-modal-title-vcenter"
            centered
            dialogClassName="modal-coustom"
            backdrop="static"
            keyboard={false}
        >
            <Modal.Body className="show-grid">
                <Container  fluid="true">
                    <LogIn relogin={true}/>
                </Container>
            </Modal.Body>
        </Modal>
    );
};

export default LogInModal;
