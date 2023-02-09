import { Language, Notifications, Search } from "@mui/icons-material";
import {
  Avatar,
  Box,
  Button,
  IconButton,
  InputAdornment,
  InputBase,
} from "@mui/material";
import React from "react";

const AdminHeader = () => {
  return (
    <Box
      className="py-4"
      sx={{ boxShadow: "0px 4px 16px rgb(43 52 69 / 10%)" }}
    >
      <div className="px-6 flex justify-between items-center">
        <Button
          startIcon={<Language />}
          size="small"
          className="color-black ml-6"
        >
          Browse Website
        </Button>
        <div className="flex gap-4">
          <InputBase
            startAdornment={
              <InputAdornment className="ml-3" position="start">
                <Search />
              </InputAdornment>
            }
            className="bg-[#F6F9FC] py-1.5"
            placeholder="Search anything..."
          />
          <IconButton>
            <Notifications />
          </IconButton>
          <IconButton className="p-0">
            <Avatar>H</Avatar>
          </IconButton>
        </div>
      </div>
    </Box>
  );
};

export default AdminHeader;
