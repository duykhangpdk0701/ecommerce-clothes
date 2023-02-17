import React from "react";
import Link from "next/link";
import { useAppDispatch } from "@/hooks/redux";
import { setOpenCartDrawer } from "@/contexts/slices/cartDrawerSlice";
//Mui comoponent
import Container from "@mui/material/Container";
import IconButton from "@mui/material/IconButton";
import Box from "@mui/material/Box";
import Badge from "@mui/material/Badge";
import Button from "@mui/material/Button";
import Paper from "@mui/material/Paper";
import InputBase from "@mui/material/InputBase";
import Popper from "@mui/material/Popper";
import Grow from "@mui/material/Grow";
import ClickAwayListener from "@mui/material/ClickAwayListener";
import MenuItem from "@mui/material/MenuItem";
import MenuList from "@mui/material/MenuList";
import InputAdornment from "@mui/material/InputAdornment";
import Divider from "@mui/material/Divider";
//mui icon
import PhoneOutlinedIcon from "@mui/icons-material/PhoneOutlined";
import EmailOutlinedIcon from "@mui/icons-material/EmailOutlined";
import ShoppingBagOutlinedIcon from "@mui/icons-material/ShoppingBagOutlined";
import PersonOutlineIcon from "@mui/icons-material/PersonOutline";
import SearchIcon from "@mui/icons-material/Search";
import KeyboardArrowDownIcon from "@mui/icons-material/KeyboardArrowDown";

const options = [
  "Create a merge commit",
  "Squash and merge",
  "Rebase and merge",
];

const Header = () => {
  const anchorRef = React.useRef<HTMLButtonElement>(null);
  const [openSearchType, setOpenSearchType] = React.useState(false);
  const [selectedIndex, setSelectedIndex] = React.useState(1);
  const dispatch = useAppDispatch();

  const handleMenuItemClick = (
    event: React.MouseEvent<HTMLLIElement, MouseEvent>,
    index: number
  ) => {
    setSelectedIndex(index);
    setOpenSearchType(false);
  };

  const handleClose = (event: Event) => {
    if (
      anchorRef.current &&
      anchorRef.current.contains(event.target as HTMLElement)
    ) {
      return;
    }

    setOpenSearchType(false);
  };

  const handleToggle = () => {
    setOpenSearchType((prevOpen) => !prevOpen);
  };

  const handleClickCartButton = () => {
    dispatch(setOpenCartDrawer());
  };

  return (
    <Box className="w-full">
      <div className="bg-[#2B3445] text-white">
        <Container className="flex justify-between px-6 h-10">
          <div className="flex items-center">
            <div className="flex items-center">
              <PhoneOutlinedIcon className="text-xl" />
              <span className="text-xs ml-1">+079607376</span>
            </div>
            <div className="flex items-center ml-5">
              <EmailOutlinedIcon className="text-xl" />
              <span className="text-xs ml-1">duykhangpdk0701@gmail.com</span>
            </div>
          </div>

          <div className="flex items-center">
            <div className="flex items-center">
              <PhoneOutlinedIcon className="text-xl" />
              <span className="text-xs ml-1">+079607376</span>
            </div>
            <div className="flex items-center ml-5">
              <EmailOutlinedIcon className="text-xl" />
              <span className="text-xs ml-1">duykhangpdk0701@gmail.com</span>
            </div>
          </div>
        </Container>
      </div>
      <Container className="flex justify-between h-20">
        <div className="min-w-[170px] flex items-center">
          <Link href="/">logo</Link>
        </div>
        <div className="flex flex-1 items-center">
          <div className="max-w-[670px] flex-1 mx-auto">
            <Paper
              elevation={0}
              variant="outlined"
              className="flex rounded-full h-11"
            >
              <InputBase
                startAdornment={
                  <InputAdornment className="ml-3" position="start">
                    <SearchIcon />
                  </InputAdornment>
                }
                placeholder="Searching for..."
                className="flex-1 text-sm"
              />
              <Divider orientation="vertical" flexItem />
              <Button
                ref={anchorRef}
                aria-controls={openSearchType ? "split-button-menu" : undefined}
                aria-expanded={openSearchType ? "true" : undefined}
                aria-label="select merge strategy"
                aria-haspopup="menu"
                onClick={handleToggle}
                variant="text"
                endIcon={<KeyboardArrowDownIcon className="mr-1" />}
                className="rounded-br-full rounded-tr-full"
              >
                {options[selectedIndex]}
              </Button>
            </Paper>
          </div>
          <Popper
            open={openSearchType}
            anchorEl={anchorRef.current}
            role={undefined}
            transition
            disablePortal
          >
            {({ TransitionProps, placement }) => (
              <Grow
                {...TransitionProps}
                style={{
                  transformOrigin:
                    placement === "bottom" ? "center top" : "center bottom",
                }}
              >
                <Paper>
                  <ClickAwayListener onClickAway={handleClose}>
                    <MenuList id="split-button-menu" autoFocusItem>
                      {options.map((option, index) => (
                        <MenuItem
                          key={option}
                          disabled={index === 2}
                          selected={index === selectedIndex}
                          onClick={(event) => handleMenuItemClick(event, index)}
                        >
                          {option}
                        </MenuItem>
                      ))}
                    </MenuList>
                  </ClickAwayListener>
                </Paper>
              </Grow>
            )}
          </Popper>
        </div>
        <div className="flex items-center">
          <Link href="/auth/login">
            <IconButton className="bg-[#F3F5F9] w-11 h-11">
              <PersonOutlineIcon />
            </IconButton>
          </Link>

          <Badge badgeContent={3} color="error">
            <IconButton
              onClick={handleClickCartButton}
              className="bg-[#F3F5F9] w-11 h-11 ml-5"
            >
              <ShoppingBagOutlinedIcon />
            </IconButton>
          </Badge>
        </div>
      </Container>
      <Box></Box>
    </Box>
  );
};

export default Header;
