import { FaCog, FaRegBell, FaRegEnvelope, FaCalendarAlt } from "react-icons/fa";
const Header = () => {

    return (
        <div className='d-flex justify-content-start flex-row header'>
            <div className='header-icon'>
                <div className='header-item-badge'>9</div>
                <FaCog />
            </div>
            <div className='header-icon'>
                <div className='header-item-badge'>9</div>
                <FaRegBell />
            </div>
            <div className='header-icon'>
                <FaRegEnvelope />
            </div>
            <div className='header-icon'>
                <div className='header-item-badge'>9</div>
                <FaCalendarAlt />
            </div>
        </div>
    );
}

export default Header;
