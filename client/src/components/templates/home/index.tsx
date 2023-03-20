import Container from "@mui/material/Container";
import React from "react";
import DealOfTheDay from "./DealOfTheDay";
import InfoBanner from "./infoBanner";
import HomeMainBanner from "./mainBanner";
import MenFashion from "./MenFashion";
import ViewProductDialog from "./viewProductDialog";
import WomenFashion from "./WomenFashion";

const HomeTemplate = () => {
  return (
    <Container>
      <HomeMainBanner />
      <InfoBanner />
      <DealOfTheDay />
      <MenFashion />
      <WomenFashion />
      <ViewProductDialog />
    </Container>
  );
};

export default HomeTemplate;
