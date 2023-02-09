import { ChevronRight, ExpandMore } from "@mui/icons-material";
import {
  Checkbox,
  Collapse,
  Divider,
  FormControlLabel,
  FormGroup,
  List,
  ListItem,
  ListItemText,
  Paper,
} from "@mui/material";
import React, { useState } from "react";
import { TEXT_COLOR_BLACK, TEXT_COLOR_GRAY } from "@/styles/color";

const ListProductSideBar = () => {
  const [open, setOpen] = useState(true);

  return (
    <Paper className="w-full py-4 px-7">
      <h6 className="text-sm font-semibold mb-2.5">Categories</h6>
      <List disablePadding>
        <ListItem
          disablePadding
          onClick={() => setOpen(!open)}
          className="py-1.5 cursor-pointer"
        >
          <ListItemText>
            <span className="text-sm " style={{ color: TEXT_COLOR_GRAY }}>
              Men
            </span>
          </ListItemText>
          {open ? (
            <ExpandMore fontSize="small" sx={{ color: TEXT_COLOR_GRAY }} />
          ) : (
            <ChevronRight fontSize="small" sx={{ color: TEXT_COLOR_GRAY }} />
          )}
        </ListItem>
        <Collapse in={open} timeout="auto" unmountOnExit>
          <List disablePadding>
            <ListItem disablePadding className="pl-5 py-1.5">
              <ListItemText>
                <span className="text-sm " style={{ color: TEXT_COLOR_GRAY }}>
                  Bubble Bath
                </span>
              </ListItemText>
            </ListItem>

            <ListItem disablePadding className="pl-5 py-1.5">
              <ListItemText>
                <span className="text-sm " style={{ color: TEXT_COLOR_GRAY }}>
                  Bath Capsules
                </span>
              </ListItemText>
            </ListItem>
          </List>
        </Collapse>
        <ListItem disablePadding className="py-1.5">
          <ListItemText>
            <span className="text-sm " style={{ color: TEXT_COLOR_GRAY }}>
              Eye Makeup Preparations
            </span>
          </ListItemText>
        </ListItem>
        <ListItem disablePadding className="py-1.5">
          <ListItemText>
            <span className="text-sm " style={{ color: TEXT_COLOR_GRAY }}>
              Fragrance
            </span>
          </ListItemText>
        </ListItem>
      </List>

      <Divider className="border-[#F3F5F9] my-6" />
      <h6 className="text-sm font-semibold mb-2.5">Categories</h6>
      <FormGroup>
        <FormControlLabel
          control={<Checkbox size="small" />}
          label={
            <span style={{ color: TEXT_COLOR_BLACK }} className="text-sm">
              Maccs
            </span>
          }
        />
        <FormControlLabel
          control={<Checkbox size="small" />}
          label={
            <span style={{ color: TEXT_COLOR_BLACK }} className="text-sm">
              Maccs
            </span>
          }
        />
        <FormControlLabel
          control={<Checkbox size="small" />}
          label={
            <span style={{ color: TEXT_COLOR_BLACK }} className="text-sm">
              Maccs
            </span>
          }
        />
        <FormControlLabel
          control={<Checkbox size="small" />}
          label={
            <span style={{ color: TEXT_COLOR_BLACK }} className="text-sm">
              Maccs
            </span>
          }
        />
      </FormGroup>
      <Divider className="border-[#F3F5F9] my-6" />
      <FormGroup>
        <FormControlLabel
          control={<Checkbox size="small" />}
          label={
            <span style={{ color: TEXT_COLOR_BLACK }} className="text-sm">
              On Sale
            </span>
          }
        />
        <FormControlLabel
          control={<Checkbox size="small" />}
          label={
            <span style={{ color: TEXT_COLOR_BLACK }} className="text-sm">
              In Stock
            </span>
          }
        />
        <FormControlLabel
          control={<Checkbox size="small" />}
          label={
            <span style={{ color: TEXT_COLOR_BLACK }} className="text-sm">
              Featured
            </span>
          }
        />
      </FormGroup>
    </Paper>
  );
};

export default ListProductSideBar;
