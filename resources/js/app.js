import './bootstrap';
import 'flowbite';

import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
import Clipboard from '@ryangjchandler/alpine-clipboard'

Alpine.plugin(Clipboard)
window.Alpine = Alpine
Livewire.start()
