<?php

namespace Wspomagacz\Enums;

enum TrainingStatus: int {
    case Planned = 1;
    case InProgress = 2;
    case Completed = 3;
}