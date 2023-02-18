import React, { Fragment } from "react";
//mui component
import Grid from "@mui/material/Grid";
//mui component
import Container from "@mui/material/Container";
import Paper from "@mui/material/Paper";
import List from "@mui/material/List";
import ListItem from "@mui/material/ListItem";
//mui icon
import ArrowForwardIcon from "@mui/icons-material/ArrowForward";
import Link from "next/link";
import MenFashionItem from "./item";
import Slider from "react-slick";

const data = [
  <MenFashionItem />,
  <MenFashionItem />,
  <MenFashionItem />,
  <MenFashionItem />,
];

const MenFashion = () => {
  return (
    <Container className="mb-16">
      <Grid container spacing={3}>
        <Grid item xs={12} md={3}>
          <Paper className="px-8 py-4">
            <h3 className="text-xl">Men's fashion</h3>
            <List className="py-2 mb-4" disablePadding>
              <ListItem disablePadding className="pt-2.5">
                Wireless Speaker
              </ListItem>
              <ListItem disablePadding className="pt-2.5">
                Wireless Speaker
              </ListItem>
              <ListItem disablePadding className="pt-2.5">
                Wireless Speaker
              </ListItem>
              <ListItem disablePadding className="pt-2.5">
                Wireless Speaker
              </ListItem>
              <ListItem disablePadding className="pt-2.5">
                Wireless Speaker
              </ListItem>
              <ListItem disablePadding className="pt-2.5">
                Wireless Speaker
              </ListItem>
            </List>

            <Link href="/product" className="no-underline text-black">
              <span className="flex gap-2 items-center pb-1 font-semibold text-sm">
                Browse All <ArrowForwardIcon className="text-sm" />
              </span>
            </Link>
          </Paper>
        </Grid>
        <Grid item xs={12} md={9}>
          <Slider slidesToShow={3} infinite>
            {data.map((item, index) => (
              <Fragment key={index}>{item}</Fragment>
            ))}
          </Slider>
        </Grid>
      </Grid>
    </Container>
  );
};

export default MenFashion;
