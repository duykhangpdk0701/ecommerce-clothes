import React, { FC, useRef, useState } from "react";
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
import Menu from "@mui/material/Menu";
import List from "@mui/material/List";
//mui icon

import PhoneOutlinedIcon from "@mui/icons-material/PhoneOutlined";
import EmailOutlinedIcon from "@mui/icons-material/EmailOutlined";
import ShoppingBagOutlinedIcon from "@mui/icons-material/ShoppingBagOutlined";
import PersonOutlineIcon from "@mui/icons-material/PersonOutline";
import SearchIcon from "@mui/icons-material/Search";
import KeyboardArrowDownIcon from "@mui/icons-material/KeyboardArrowDown";
import { useRouter } from "next/router";

const options = [
  "Create a merge commit",
  "Squash and merge",
  "Rebase and merge",
];

interface IHeader {
  quoteItemLength: number;
}

const Header: FC<IHeader> = (props) => {
  const { quoteItemLength } = props;

  const router = useRouter();

  const anchorRef = useRef<HTMLButtonElement>(null);

  const anchorAccountMenuRef = useRef<HTMLButtonElement>(null);

  const [openSearchType, setOpenSearchType] = useState(false);

  const [openAccountMenu, setOpenAccountMenu] = useState(false);

  const [selectedIndex, setSelectedIndex] = useState(1);
  const dispatch = useAppDispatch();

  const handleClickAccountmenu = () => {
    setOpenAccountMenu((preOpen) => !preOpen);
  };

  const handleCloseAccountMenu = (event: Event) => {
    if (
      anchorAccountMenuRef.current &&
      anchorAccountMenuRef.current.contains(event.target as HTMLElement)
    ) {
      return;
    }

    setOpenAccountMenu(false);
  };

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

  const handleClickLogout = (e: any) => {
    router.push("/auth/login");
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
                variant="contained"
                className="rounded-br-full rounded-tr-full px-10"
              >
                Search
              </Button>
            </Paper>
          </div>
        </div>
        <div className="flex items-center">
          <div>
            <IconButton
              // LinkComponent={Link}
              // href="/auth/login"
              ref={anchorAccountMenuRef}
              className="bg-[#F3F5F9] w-11 h-11"
              onClick={handleClickAccountmenu}
              aria-controls={
                openAccountMenu ? "account-button-menu" : undefined
              }
              aria-expanded={openAccountMenu ? "true" : undefined}
              aria-label="select merge strategy"
              aria-haspopup="menu"
            >
              <PersonOutlineIcon />
            </IconButton>
            <Popper
              open={openAccountMenu}
              anchorEl={anchorAccountMenuRef.current}
              role={undefined}
              transition
              disablePortal
              className="z-30"
            >
              {({ TransitionProps, placement }) => (
                <Grow
                  {...TransitionProps}
                  style={{
                    transformOrigin:
                      placement === "bottom" ? "center top" : "center bottom",
                  }}
                >
                  <Paper elevation={1} className="min-w-[150px]">
                    <ClickAwayListener onClickAway={handleCloseAccountMenu}>
                      <MenuList
                        id="account-button-menu"
                        autoFocusItem
                        onClick={() => setOpenAccountMenu(false)}
                      >
                        <Link
                          href="/order"
                          className="no-underline text-inherit"
                        >
                          <MenuItem>Order</MenuItem>
                        </Link>

                        <Link
                          href="/profile"
                          className="no-underline text-inherit"
                        >
                          <MenuItem>Profile</MenuItem>
                        </Link>

                        <Link
                          href="/address"
                          className="no-underline text-inherit"
                        >
                          <MenuItem>Address</MenuItem>
                        </Link>

                        <MenuItem onClick={handleClickLogout}>Log In</MenuItem>
                      </MenuList>
                    </ClickAwayListener>
                  </Paper>
                </Grow>
              )}
            </Popper>
          </div>

          <Badge badgeContent={quoteItemLength} color="error">
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
